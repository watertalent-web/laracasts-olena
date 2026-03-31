<?php

declare(strict_types=1);

it('register a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@doe.com')
        ->fill('password', 'Password')
        ->click('Create Account')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@doe.com',
    ]);
});
