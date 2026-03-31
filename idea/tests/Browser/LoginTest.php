<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('login a user', function () {

    $user = User::factory()->create([
        'name' => 'Olena Beliavska',
        'email' => 'olena.beliavska@icloud.com',
        'password' => bcrypt('Password'),
    ]);

    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'Password')
        ->click('@login-button')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Olena Beliavska',
        'email' => 'olena.beliavska@icloud.com',
    ]);
});

it('logs out a user', function () {
    $user = User::factory()->create([
        'name' => 'Olena Beliavska',
        'email' => 'olena.beliavska@icloud.com',
        'password' => bcrypt('Password'),
    ]);
    $this->actingAs($user);

    visit('/')
        ->click('Logout');

    $this->assertGuest();
});
