<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;
use App\Models\Usuario;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(2);

        $clientes = DB::table('clientes as c')
        ->join('users as u', 'u.id','c.id_user')
        ->where('c.estado','a')
        ->select('c.nombre as nombre', 'c.id as id', 'c.direccion as direccion','c.telefono as telefono', 'u.email as usuario','c.estado as estado')
        ->orderBy('c.id','asc')
        ->get();

        return view('Cliente.index', compact('clientes','num'));
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
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Crear el usuario
        $user = Usuario::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'estado' => 'a',
            'id_empresa' => 1,
            'id_rol' => 3,
        ]);

        // Crear el cliente
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'id_user' => $user->id,
            'estado' => 'a',
        ]);

        return redirect()->route('cliente.index')->with('success', 'Cliente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email,' . $cliente->user->id,
        ]);
        
        //dd($cliente);
        // Actualizar el usuario
        $cliente->user->update([
            'email' => $request->email,
        ]);
    
        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $cliente->user->update([
                'password' => bcrypt($request->password),
            ]);
        }
    
        // Actualizar el cliente
        $cliente->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);
    
        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->update(['estado' => 'i']);

        // Cambiar el estado del usuario asociado a 'i'
        $cliente->user->update(['estado' => 'i']);

        return redirect()->route('cliente.index')->with('success', 'Cliente desactivado exitosamente');
    }
}
