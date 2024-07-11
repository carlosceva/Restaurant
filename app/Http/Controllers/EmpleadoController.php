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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required|digits:8|max:8',
            'turno' => 'required',
            'ci' => 'required|unique:empleados',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Crear el usuario
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => 'activo',
        ]);

        // Crear el empleado
        $empleado = Empleado::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'turno' => $request->turno,
            'ci' => $request->ci,
            'id_user' => $user->id,
            'estado' => 'activo',
        ]);

        return redirect()->route('empleado.index')->with('success', 'Empleado creado exitosamente');
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
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required|digits:8|max:8',
            'turno' => 'required',
            'ci' => 'required|unique:empleados,ci,' . $empleado->id,
            'email' => 'required|email|unique:users,email,' . $empleado->user->id,
        ]);
    
        // Actualizar el usuario
        $empleado->user->update([
            'email' => $request->email,
        ]);
    
        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $empleado->user->update([
                'password' => Hash::make($request->password),
            ]);
        }
    
        // Actualizar el empleado
        $empleado->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'turno' => $request->turno,
            'ci' => $request->ci,
        ]);
    
        return redirect()->route('empleado.index')->with('success', 'Empleado actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->update(['estado' => 'i']);

        // Cambiar el estado del usuario asociado a 'i'
        $empleado->user->update(['estado' => 'i']);

        return redirect()->route('empleado.index')->with('success', 'Empleado desactivado exitosamente');
    }
}
