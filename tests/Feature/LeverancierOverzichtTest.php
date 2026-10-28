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
