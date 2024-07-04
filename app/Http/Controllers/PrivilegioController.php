<?php

namespace App\Http\Controllers;

use App\Models\Privilegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivilegioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$privilegios = Privilegio::all();

        $privilegios = DB::table('privilegios as p')
                    ->join('roles as r','p.id_rol','r.id')
                    ->where('p.estado','a')
                    ->select('p.id as id','p.funcionalidad as funcion','r.nombre as rol','p.agregar as agregar','p.borrar as borrar','p.modificar as modificar','p.leer as leer','p.estado as estado')
                    ->orderBy('p.id','asc')
                    ->get();

        return view('Privilegio.index', compact('privilegios'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Privilegio $privilegio)
    {
        //
    }
}
