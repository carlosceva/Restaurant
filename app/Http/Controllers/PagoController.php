<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;
use App\Models\Cliente;
use App\Models\Venta;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = auth()->user();

        $contar = new Contador();
        $num = $contar->contarModel(5);

        $rol = $usuario->rol->nombre;
        
        if ($usuario->rol->nombre === 'Cliente') {
            $idCliente = $usuario->cliente->id; 
            $pagos = DB::table('pagos as p')
                ->join('clientes as c', 'c.id', '=', 'p.id_cliente')
                ->join('ventas as v', 'v.id', '=', 'p.id_venta') // Join with ventas table
                ->where('p.estado', 'a')
                ->where('p.id_cliente', $idCliente)
                ->select(
                    'p.id as id', 
                    'p.metodo_pago as metodopago', 
                    'c.nombre as cliente', 
                    'v.total as total_venta', // Total from ventas table
                    'v.fecha as fecha_venta', // Date from ventas table
                    'p.estado as estado', 
                    'p.id_venta as id_venta',
                    'p.id_cliente as id_cliente'
                )
                ->orderBy('p.id', 'asc')
                ->get();
        }
        
        if ($usuario->rol->nombre == 'Administrador' || $usuario->rol->nombre == 'Cajero') {
            $pagos = DB::table('pagos as p')
                ->join('clientes as c', 'c.id', '=', 'p.id_cliente')
                ->join('ventas as v', 'v.id', '=', 'p.id_venta') // Join with ventas table
                ->where('p.estado', 'a')
                ->select(
                    'p.id as id', 
                    'p.metodo_pago as metodopago', 
                    'c.nombre as cliente', 
                    'v.total as total_venta', // Total from ventas table
                    'v.fecha as fecha_venta', // Date from ventas table
                    'p.estado as estado', 
                    'p.id_venta as id_venta',
                    'p.id_cliente as id_cliente'
                )
                ->orderBy('p.id', 'asc')
                ->get();
        }
        
        $clientes = Cliente::where('estado', 'a')->get();
        $ventas = Venta::where('estado', 'a')->get();
        
        return view('Pago.index', compact('pagos', 'num', 'clientes', 'ventas','usuario'));
        
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

        $pago = new Pago();
        $pago->id_cliente = $request->id_cliente; 
        $pago->id_venta = $request->id_venta;
        $pago->metodo_pago = $request->metodo;
        $pago->estado = 'a';
        $pago->save();

        return redirect()->route('pago.index')->with('success', 'Pago creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        /*$request->validate([
            'rol_id' => 'required|exists:roles,id', // Validamos que el rol exista
            'funcion' => 'required',
            'estado' => 'required|in:a,i',
        ]);*/

        $pago->id_cliente = $request->id_cliente; 
        $pago->id_venta = $request->id_venta;
        $pago->metodo_pago = $request->metodo;
        $pago->estado = $request->estado;
        $pago->save();

        return redirect()->route('pago.index')->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        $pago->estado = 'i';
        $pago->save();

        return redirect()->route('pago.index')->with('success', 'Pago desactivado exitosamente.');
    }
}
