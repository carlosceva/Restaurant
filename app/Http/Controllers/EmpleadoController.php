<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(3);

        $empleados = DB::table('empleados as e')
        ->join('users as u', 'u.id','e.id_user')
        ->where('e.estado','a')
        ->select('e.nombre as nombre', 'e.id as id', 'e.ci as ci','e.telefono as telefono', 'u.email as usuario','e.estado as estado','e.turno as turno')
        ->orderBy('e.id','asc')
        ->get();

        return view('Empleado.index', compact('empleados','num'));
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
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
