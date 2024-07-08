<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(1);

        $categorias = DB::table('categorias')
                    ->where('estado','a')
                    ->get();

        return view('Categoria.index', compact('categorias','num'));
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
            'nombre' => 'required|string|max:255'
        ]);
        
        try {
            
            $categoria = Categoria::create([
                'nombre' => $request->input('nombre'),
                'estado' => 'a',
            ]);

            $categoria->save();

            Session::flash('success', 'Categoria agregada exitosamente.');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al guardar categoria.');
        }
    
        return redirect()->route('categoria.index');
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
    public function update(Request $request, $id)
    {
        /*$request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|integer',
        ]);*/

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());

        return redirect()->route('categoria.index')->with('success', 'Categoria actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update(['estado' => 'i']);

        return redirect()->route('categoria.index')->with('success', 'Categoria eliminada exitosamente.');
    }
}
