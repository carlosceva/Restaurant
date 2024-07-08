<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(11);

        $usuarios = DB::table('users as u')
        ->join('roles as r', 'r.id','u.id_rol')
        ->join('empresas as e','e.id','u.id_empresa')
        ->select('r.nombre as rol', 'e.nombre as empresa', 'u.id as user','u.email as correo', 'u.estado as estado')
        ->orderBy('u.id','asc')
        ->get();

        return view('Usuario.index', compact('usuarios','num'));
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
        /*$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telefono' => 'required|integer',
            'rol'=>'required',
        ]);*/
        
        try {
            
            $usuario = Usuario::create([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'id_rol' => $request->input('rol'),
                'id_empresa' => 1,
                'estado' => 'a',
            ]);

            $usuario->save();

            Session::flash('success', 'Usuario agregado exitosamente.');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al guardar usuario.');
        }
    
        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /*$request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|integer',
        ]);*/

        $oferta = Usuario::findOrFail($id);
        $oferta->update($request->all());

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $oferta = Usuario::findOrFail($id);
        $oferta->update(['estado' => 'i']);

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
