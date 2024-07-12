<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contador;
use App\Models\Usuario;
use App\Models\Venta;


class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cantidadVentas = DB::table('ventas')
            ->where('estado', 'a')
            ->count();
        
        $cantidadVendida = DB::table('ventas')
            ->where('estado', 'a')
            ->sum('total');

        $cantidadClientes = DB::table('clientes')
            ->where('estado', 'a')
            ->count();

        $cantidadVisitas = DB::table('contadors')
            ->sum('visitas');

        $ventasMes = DB::select("select date_part('month', TO_DATE(fecha, 'yyyy-mm-dd')) as mes, count(*) as cantidad from ventas group by mes order by mes asc");

        $mes =[];
        $cantidad = [];
        foreach($ventasMes as $item ){
            array_push($mes, $item->mes);
            array_push($cantidad, $item->cantidad);
        };
        //dd($mes, $cantidad);   

        return view('Reportes.index', compact('cantidadVentas','cantidadVendida','cantidadClientes','cantidadVisitas','mes','cantidad'));
    
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buscador(Request $r)
    {
        //dd($r->buscar);
        $search = strtolower($r->buscar);
        $data = DB::select("select 'http://127.0.0.1:8000/producto' as ruta, nombre, 'productos' as modelo from productos where lower(nombre) like '%". $search."%' union all select 'http://127.0.0.1:8000/cliente' as ruta, nombre, 'clientes' as modelo from clientes where lower(nombre) like '%". $search."%'");
        return view('Estadisticas.index',compact('data'));
    }

    public function estadisticas()
    {
            $datos = Contador::select('nombre', 'visitas')->orderBy('id','asc')->get();

        return view('Estadisticas.resultado',compact('datos'));
    }
}
