<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contador;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\User;
use DateTime;


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

        $ventasMes = DB::select("select date_part('month', TO_DATE(fecha, 'yyyy-mm-dd')) as mes, count(*) as cantidad from ventas where estado='a' group by mes order by mes asc");

        $mes =[];
        $cantidad = [];
        foreach($ventasMes as $item ){
            $fecha = DateTime::createFromFormat('!m', $item->mes);
            array_push($mes, $fecha->format('F'));
            array_push($cantidad, $item->cantidad);
        };
        //dd($mes, $cantidad);
        
        $ventasDia = DB::select("select TO_CHAR(TO_DATE(fecha, 'yyyy-mm-dd'), 'YYYY-MM-DD') as dia, count(*) as cantidad from ventas where estado='a' group by dia order by dia asc");

        $dias = [];
        $cantidadDias = [];
        foreach($ventasDia as $item) {
            array_push($dias, $item->dia);
            array_push($cantidadDias, $item->cantidad);
        }
        //dd($dias, $cantidadDias);

        $productosTop = DB::select("
            SELECT p.nombre AS producto, SUM(dv.cantidad) AS total_vendido
            FROM productos p
            INNER JOIN detalle_ventas dv ON p.id = dv.id_producto
            INNER JOIN ventas v ON dv.id_venta = v.id
            WHERE v.estado = 'a'
            GROUP BY p.id, p.nombre
            ORDER BY total_vendido DESC
            LIMIT 5
        ");

        return view('Reportes.index', compact('cantidadVentas','cantidadVendida','cantidadClientes','cantidadVisitas','mes','cantidad','dias','cantidadDias','productosTop'));
    
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
        $rutaTecno = 'http://127.0.0.1:8000/';
        $rutaTecnos = 'http://mail.tecnoweb.org.bo/inf513/grupo12sc/Restaurant/public/';

        $search = strtolower($r->buscar);
        $tablas = [
            ['productos', 'nombre', 'producto'],
            ['clientes', 'nombre', 'cliente'],
            ['categorias', 'nombre', 'categoria'],
            ['promocions', 'fecha_i', 'promocion'],
            ['menus', 'descripcion', 'menu'],
            ['roles', 'nombre', 'rol'],
            ['servicios', 'descripcion', 'servicio'],
            ['privilegios', 'funcionalidad', 'privilegio'],
            ['users', 'email', 'usuario'],
            ['empleados', 'nombre', 'empleado'],
            ['ventas', 'fecha', 'venta'],
            ['pagos', 'metodo_pago', 'pago'],
            ['productos','descripcion','producto'],
            ['clientes','direccion','cliente'],
        ];

        $data = [];
        foreach ($tablas as $tabla) {
            $resultados = DB::table($tabla[0])
                ->select(DB::raw("'$rutaTecno$tabla[2]' as ruta, $tabla[1] as nombre, '$tabla[0]' as modelo"))
                ->whereRaw("lower($tabla[1]) like ?", ["%$search%"])
                ->get();
            $data = array_merge($data, $resultados->toArray());
        }
        return view('Estadisticas.index',compact('data'));
    }

    public function estadisticas()
    {
            $datos = Contador::select('nombre', 'visitas')->orderBy('id','asc')->get();

        return view('Estadisticas.resultado',compact('datos'));
    }

    public function cargarEstilo($id){
        $usuario=auth()->user()->id;
        
        $usuario2 = User::find($usuario);
        $usuario2->estilo=$id;
        $usuario2->update();
        return redirect()->back();
    }
}
