<?php

namespace App\Http\Controllers;

// Importamos las clases para crear nuestros objetos.
use App\Dominio\Persona;
use App\Dominio\Aprendiz;
use App\Models\Aprendiz as AprendizModelo; // Modelo que guarda en la tabla aprendices.
use Illuminate\Http\Request; // Permite recibir los datos enviados desde el formulario.

class PersonaController extends Controller
{
    // Muestra el ejemplo inicial al visitar /personas.
    public function mostrar()
    {
        // Creamos una persona y un aprendiz con datos de ejemplo.
        $persona = new Persona('Carlos');
        $aprendiz = new Aprendiz('Ana', 'ADSO');

        // Agrupamos los objetos en un arreglo.
        $personas = [$persona, $aprendiz];

        // Enviamos el arreglo a la vista personas.blade.php.
        return view('personas', [
            'personas' => $personas,
        ]);
    }

    // Recibe los datos al presionar "Presentar aprendiz".
    public function presentar(Request $request)
    {
        // Validamos los campos antes de crear el objeto.
        $datos = $request->validate(
            [
                // Nombre obligatorio, de tipo texto y máximo 100 caracteres.
                'nombre' => ['required', 'string', 'max:100'],

                // Programa obligatorio, de tipo texto y máximo 150 caracteres.
                'programa' => ['required', 'string', 'max:150'],
            ],
            [
                // Mensajes personalizados para el campo nombre.
                'nombre.required' => 'Debes ingresar el nombre del aprendiz.',
                'nombre.string' => 'El nombre debe ser un texto.',
                'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

                // Mensajes personalizados para el campo programa.
                'programa.required' => 'Debes ingresar el programa de formación.',
                'programa.string' => 'El programa debe ser un texto.',
                'programa.max' => 'El programa no puede superar los 150 caracteres.',
            ]
        );

        AprendizModelo::create($datos); // Guarda el nombre y el programa validados en MySQL.
        // Si la validación falla, Laravel regresa al formulario.
        // Si pasa, continúa y crea el objeto con los datos validados.
        $aprendiz = new Aprendiz(
            $datos['nombre'],
            $datos['programa']
        );

        // Enviamos el aprendiz dentro de un arreglo.
        // La vista recorrerá ese arreglo y ejecutará presentarse().
        return view('personas', [
            'personas' => [$aprendiz],
        ]);
    }

    
 public function actualizar(Request $request, $id)
    {
        // Validamos los datos enviados desde el formulario de edición
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'programa' => ['required', 'string', 'max:150'],
        ], [
            'nombre.required' => 'Debes ingresar el nombre del aprendiz.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'programa.required' => 'Debes ingresar el programa de formación.',
            'programa.string' => 'El programa debe ser un texto.',
            'programa.max' => 'El programa no puede superar los 150 caracteres.',
        ]);

        // Buscamos el aprendiz por su ID y actualizamos sus datos
        $aprendiz = AprendizModelo::findOrFail($id);
        $aprendiz->update($datos);

        // Redirigimos de vuelta al listado de aprendices
        return redirect('/aprendices');
    }


    public function listar(){
    // Consulta los aprendices en MySQL y los ordena por id de mayor a menor.
    $aprendices = AprendizModelo::orderByDesc('id')->get();

    // Envía los registros a la vista con el nombre $aprendices.
    return view('aprendices.index', ['aprendices' => $aprendices]);
}
}