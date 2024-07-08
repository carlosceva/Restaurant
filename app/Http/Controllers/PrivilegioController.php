<?php

namespace App\Http\Controllers;

use App\Models\Privilegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;
use App\Models\Role;

class PrivilegioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(6);

        $privilegios = Privilegio::with('rol')->where('estado', 'a')->get();
        $roles = Role::where('estado', 'a')->get();

        return view('Privilegio.index', compact('privilegios','roles','num'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id', // Validamos que el rol exista
            'funcion' => 'required',
        ]);

        $privilegio = new Privilegio();
        $privilegio->id_rol = $request->rol_id; // Guardamos el ID del rol
        $privilegio->funcionalidad = $request->funcion;
        $privilegio->agregar = $request->has('agregar');
        $privilegio->borrar = $request->has('borrar');
        $privilegio->modificar = $request->has('modificar');
        $privilegio->leer = $request->has('leer');
        $privilegio->estado = 'a';
        $privilegio->save();

        return redirect()->route('privilegio.index')->with('success', 'Privilegio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Privilegio $privilegio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Privilegio $privilegio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Privilegio $privilegio)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id', // Validamos que el rol exista
            'funcion' => 'required',
            'estado' => 'required|in:a,i',
        ]);

        $privilegio->id_rol = $request->rol_id; // Actualizamos el ID del rol
        $privilegio->funcionalidad = $request->funcion;
        $privilegio->agregar = $request->has('agregar');
        $privilegio->borrar = $request->has('borrar');
        $privilegio->modificar = $request->has('modificar');
        $privilegio->leer = $request->has('leer');
        $privilegio->estado = $request->estado;
        $privilegio->save();

        return redirect()->route('privilegio.index')->with('success', 'Privilegio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Privilegio $privilegio)
    {
        $privilegio->estado = 'i';
        $privilegio->save();
        return redirect()->route('privilegio.index')->with('success', 'Privilegio desactivado exitosamente.');
    }
}
