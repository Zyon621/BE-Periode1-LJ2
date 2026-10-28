<?php

use App\Models\User;

beforeEach(function () {
    $this->magazijnmedewerker = User::factory()->create(['role' => 'magazijn_medewerker']);
});

test('gast wordt doorgestuurd naar de loginpagina', function () {
    $this->get('/leveranciers')->assertRedirect('/login');
});

test('klant heeft geen toegang tot het overzicht leveranciers', function () {
    $klant = User::factory()->create(['role' => 'klant']);

    $this->actingAs($klant)->get('/leveranciers')->assertForbidden();
});

test('overzicht leveranciers toont alle leveranciers gesorteerd op aantal producten aflopend', function () {
    $response = $this->actingAs($this->magazijnmedewerker)->get('/leveranciers');

    $response->assertOk()
        ->assertSee('Overzicht leveranciers')
        ->assertSeeInOrder(['Venco', 'Bert van Linge', 'L1029384719', '06-28493827'])
        ->assertSeeInOrder(['Basset', 'Quality Street']);
});

test('het aantal verschillende producten van Venco is 3', function () {
    $leveranciers = (new App\Models\LeverancierModel)->getOverzicht();

    $venco = collect($leveranciers)->firstWhere('Naam', 'Venco');
    $aantallen = collect($leveranciers)->pluck('AantalVerschillendeProducten')->all();

    expect((int) $venco->AantalVerschillendeProducten)->toBe(3)
        ->and($aantallen)->toBe(collect($aantallen)->sortDesc()->values()->all());
});

test('scenario 01: detailscherm toont de geleverde producten van Venco gesorteerd op aantal in magazijn aflopend', function () {
    $venco = collect((new App\Models\LeverancierModel)->getOverzicht())->firstWhere('Naam', 'Venco');

    $response = $this->actingAs($this->magazijnmedewerker)->get("/leveranciers/{$venco->Id}/producten");

    $response->assertOk()
        ->assertSee('Geleverde producten')
        ->assertSeeInOrder(['Naam leverancier', 'Venco', 'Bert van Linge', 'L1029384719', '06-28493827'])
        ->assertSeeInOrder(['Mintnopjes', '453', '5 kg', '18-11-2024'])
        ->assertSeeInOrder(['Mintnopjes', 'Schoolkrijt', 'Honingdrop']);
});

test('detailscherm van een onbekende leverancier geeft een 404', function () {
    $this->actingAs($this->magazijnmedewerker)->get('/leveranciers/99/producten')->assertNotFound();
});

test('scenario 02: leverancier zonder geleverde producten toont melding en stuurt na 3 seconden terug', function () {
    $qualityStreet = collect((new App\Models\LeverancierModel)->getOverzicht())->firstWhere('Naam', 'Quality Street');

    $response = $this->actingAs($this->magazijnmedewerker)->get("/leveranciers/{$qualityStreet->Id}/producten");

    $response->assertOk()
        ->assertSee('Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin')
        ->assertSee('Johan Nooij')
        ->assertSee('}, 3000);', false)
        ->assertSee(route('leveranciers.index'), false);
});

test('scenario 02: leverancier met producten stuurt niet automatisch door', function () {
    $venco = collect((new App\Models\LeverancierModel)->getOverzicht())->firstWhere('Naam', 'Venco');

    $this->actingAs($this->magazijnmedewerker)->get("/leveranciers/{$venco->Id}/producten")
        ->assertDontSee('}, 3000);', false)
        ->assertDontSee('geen producten geleverd');
});
