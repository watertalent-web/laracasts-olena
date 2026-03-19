<?php

use App\Models\User;

it('register', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@doe.com')
        ->fill('password', 'Password')

        ->press('[data-test="register-button"]')
        ->assertPathIs('/ideas')
        ->debug();

    expect(User::where('email', 'john@doe.com')->ex())->toBe(1);

    $this->assertAuthenticated();
});
