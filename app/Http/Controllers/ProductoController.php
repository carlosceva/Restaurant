<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(7);

        $productos = DB::table('productos as p')
                    ->join('categorias as c', 'c.id','p.id_categoria')
                    ->where('p.estado','a')
                    ->select('p.id as id','p.nombre as nombre','p.descripcion as descripcion','c.nombre as categoria','p.precio as precio','p.estado as estado','p.id_categoria as id_categoria')
                    ->orderBy('p.id','asc')
                    ->get();

        $categorias = Categoria::where('estado','a')->get();                    

        return view('Producto.index', compact('productos','num', 'categorias'));
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
            'rol_id' => 'required|exists:roles,id', // Validamos que el rol exista
            'funcion' => 'required',
        ]);*/

        $producto = new Producto();
        $producto->nombre = $request->nombre; 
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->id_categoria = $request->categoria;
        $producto->estado = 'a';
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        /*$request->validate([
            'rol_id' => 'required|exists:roles,id', // Validamos que el rol exista
            'funcion' => 'required',
            'estado' => 'required|in:a,i',
        ]);*/

        $producto->nombre = $request->nombre; // Actualizamos el ID del rol
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->id_categoria = $request->categoria;
        $producto->estado = $request->estado;
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Privilegio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->estado = 'i';
        $producto->save();
        return redirect()->route('producto.index')->with('success', 'Producto desactivado exitosamente.');
    }
}
