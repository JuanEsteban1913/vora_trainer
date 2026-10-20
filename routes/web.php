<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes - Vora Trainer
|--------------------------------------------------------------------------
*/

// 1. Vista de Inicio / Login
Route::get('/', function () {
    return view('inicio');
})->name('login');

// 2. Procesar Inicio de Sesión
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Usamos 'password_hash' tal como está configurado en la base de datos
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas son incorrectas.',
    ]);
});

// 3. Vista de Registro
Route::get('/register', function () {
    return view('registro');
})->name('register');

// 4. Procesar Registro (Rol por defecto cliente + Envío de correo a Mailpit)
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'user_name' => $request->name,
        'email' => $request->email,
        'password_hash' => Hash::make($request->password),
        'role' => 'cliente', // Blindado: rol por defecto seguro
        'is_active' => 1,
    ]);

    // Dispara el evento que genera el correo de verificación hacia Mailpit
    event(new Registered($user));

    auth()->login($user);
    $request->session()->regenerate();

    // Redirige al aviso de verificación de correo
    return redirect('/email/verify');
});

// 5. Panel Principal (Protegido: exige autenticación y correo verificado)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

// 6. Cerrar Sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');