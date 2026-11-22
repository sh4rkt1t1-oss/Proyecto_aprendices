<?php

// Importa Route para definir las direcciones web de la aplicación.
use Illuminate\Support\Facades\Route;

// Importa el controlador que preparará los datos de las personas.
use App\Http\Controllers\PersonaController;

// Define la ruta de la página inicial.
// Se ejecuta al visitar http://127.0.0.1:8000/
Route::get('/', function () {

    // Muestra la vista ubicada en:
    // resources/views/welcome.blade.php
    return view('welcome');
});

// Define la ruta para mostrar las presentaciones de las personas.
// Se ejecuta al visitar http://127.0.0.1:8000/personas
// PersonaController::class identifica el controlador que atenderá la solicitud.
// 'mostrar' indica el método que Laravel ejecutará dentro de ese controlador.
Route::get('/personas', [PersonaController::class, 'mostrar']);

// Muestra la vista resources/views/formulario.blade.php.
Route::view('/aprendices/crear', 'formulario');

// Recibe el formulario enviado mediante POST.
// Ejecuta el método presentar del controlador PersonaController.
Route::post('/aprendices', [PersonaController::class, 'presentar']);

// Al abrir /aprendices, ejecuta listar() para mostrar los registros de MySQL.
Route::get('/aprendices', [PersonaController::class, 'listar']);
