<?php

use App\Models\LeverancierModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->magazijnmedewerker = User::factory()->create(['role' => 'magazijn_medewerker']);
});

// sp_VoegLeveringToe voert zelf een COMMIT uit, daarom wordt de database na elke test opnieuw opgebouwd.
afterEach(function () {
    $this->artisan('migrate:fresh');
});

function leverancierId(string $naam): int
{
    return (int) collect((new LeverancierModel)->getOverzicht())->firstWhere('Naam', $naam)->Id;
}

function productId(string $naam): int
{
    return (int) DB::table('product')->where('Naam', $naam)->value('Id');
}

test('scenario 01: plus-icoon opent het scherm Levering product van Mintnopjes', function () {
    $venco = leverancierId('Venco');

    $this->actingAs($this->magazijnmedewerker)
        ->get("/leveranciers/{$venco}/producten")
        ->assertSee("/leveranciers/{$venco}/producten/".productId('Mintnopjes').'/levering', false);

    $this->actingAs($this->magazijnmedewerker)
        ->get("/leveranciers/{$venco}/producten/".productId('Mintnopjes').'/levering')
        ->assertOk()
        ->assertSeeInOrder(['Levering Product', 'Mintnopjes', 'Venco', 'Bert van Linge', '06-28493827'])
        ->assertSee('Aantal producteenheden')
        ->assertSee('Datum eerstvolgende levering')
        ->assertSee('Sla op');
});

test('scenario 01: nieuwe levering verhoogt het aantal in het magazijn en wijzigt de laatste levering', function () {
    $venco = leverancierId('Venco');
    $mintnopjes = productId('Mintnopjes');

    $response = $this->actingAs($this->magazijnmedewerker)
        ->post("/leveranciers/{$venco}/producten/{$mintnopjes}/levering", [
            'Aantal' => 25,
            'DatumEerstvolgendeLevering' => '2024-05-29',
        ]);

    $response->assertRedirect("/leveranciers/{$venco}/producten");

    expect((int) DB::table('magazijn')->where('ProductId', $mintnopjes)->value('AantalAanwezig'))->toBe(478);

    $this->actingAs($this->magazijnmedewerker)
        ->get("/leveranciers/{$venco}/producten")
        ->assertSeeInOrder(['Mintnopjes', '478', now()->format('d-m-Y')])
        ->assertSee('De levering van Mintnopjes is opgeslagen.');
});

test('levering zonder geldig aantal of datum wordt niet opgeslagen', function () {
    $venco = leverancierId('Venco');
    $mintnopjes = productId('Mintnopjes');

    $this->actingAs($this->magazijnmedewerker)
        ->post("/leveranciers/{$venco}/producten/{$mintnopjes}/levering", ['Aantal' => 0, 'DatumEerstvolgendeLevering' => 'geen-datum'])
        ->assertSessionHasErrors(['Aantal', 'DatumEerstvolgendeLevering']);

    expect((int) DB::table('magazijn')->where('ProductId', $mintnopjes)->value('AantalAanwezig'))->toBe(453);
});
