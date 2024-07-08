<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(10);

        $servicios = DB::table('servicios')
                    ->where('estado','a')
                    ->get();

        return view('Servicio.index', compact('servicios','num'));
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
            'descripcion' => 'required|string|max:255'
        ]);
        
        try {
            
            $servicio = Servicio::create([
                'descripcion' => $request->input('descripcion'),
                'estado' => 'a',
            ]);

            $servicio->save();

            Session::flash('success', 'Servicio agregado exitosamente.');
        } catch (\Exception $e) {
            Session::flash('error', 'Ocurrió un error al guardar servicio.');
        }
    
        return redirect()->route('servicio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
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

        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());

        return redirect()->route('servicio.index')->with('success', 'Servicio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->update(['estado' => 'i']);

        return redirect()->route('servicio.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
