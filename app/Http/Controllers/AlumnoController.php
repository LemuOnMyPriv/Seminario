<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*modelos*/
use App\Models\Alumno;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all(); /*select * from alumnos */
        /* dd($alumnos); Nos permite mostrar el contenido de una variable o arreglo y a la vez detiene la ejecucion del script*/
        return view('alumnos.index', compact('alumnos')); /*Retorna la vista de alumnos*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:40',
            'apellido' => 'required|string|max:40',
            'email' => 'required',
            'edad' => 'required|integer',
        ]);
        Alumno::create([
            'nombre' => $request->name,/*abdias*/
            'apellido' => $request->lastname,/*cevallos*/
            'email' => $request->mail,/*abcdefg@unicah.com*/
            'edad' => $request->age,/*21*/
        ]);
        return redirect()->route('alumnos.index')
            ->with('success', 'Estudiante agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //dd($alumno);
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $alumno = Alumno::findOrFail($id);

        // Validar los datos, asegurando que el email sea único, excepto para el alumno actual
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:alumnos,email,' . $alumno->id,
            'edad' => 'required|integer',

        ]);

        // Actualizar los datos del alumno
        $alumno->update($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->Delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
