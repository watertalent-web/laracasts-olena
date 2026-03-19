<?php

use App\Models\User;

it('shows all ideas', function () {
    $this->actingAs($user = User::factory()->create());

    $user->ideas()->create([
        'description' => 'My first idea',
        'state' => 'pending',
    ]);

    visit('/ideas')
        ->assertSee('My first idea');
});

it('shows a single idea', function () {});

it('shows an edit form to create an idea', function () {});
