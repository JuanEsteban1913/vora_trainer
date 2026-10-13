<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $this->withoutExceptionHandling();

    $response = $this->post(route('register.store'), [
        'user_name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'user_name' => 'Test User',
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
});
