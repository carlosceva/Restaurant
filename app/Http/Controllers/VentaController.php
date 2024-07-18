<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Servicio;
use App\Models\Promocion;
use App\Models\DetalleVenta;
use Carbon\Carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $usuario = auth()->user();
        
        $contar = new Contador();
        $num = $contar->contarModel(12);
        
        $rol = $usuario->rol->nombre;
        

        if($usuario->rol->nombre === 'Cliente'){
            $idCliente = $usuario->cliente->id; 
            $ventas = Venta::where('id_cliente', $idCliente)
                     ->where('estado', 'a')
                     ->get();
        }
        //$ventas = Venta::with(['cliente', 'empleado', 'promocion', 'servicio', 'detalleVentas.producto'])->get();
        //return view('Venta.index', compact('ventas','num'));

        if($usuario->rol->nombre === 'Cajero'){
            $idEmpleado = $usuario->empleado->id; 
            $ventas = Venta::where('id_empleado', $idEmpleado)
                     ->where('estado', 'a')
                     ->get();
        }

        if($usuario->rol->nombre == 'Administrador' ){
            
            $ventas = Venta::with(['cliente', 'empleado', 'promocion', 'servicio'])
                        ->where('estado', 'a')->get();
        } 
        
        $clientes = Cliente::where('estado','a')->get();
        $empleados = Empleado::where('estado','a')->get();
        $promociones = Promocion::where('estado','a')->get();
        $servicios = Servicio::where('estado','a')->get();
        $productos = Producto::where('estado','a')->get(); 

        return view('Venta.index', compact('ventas','clientes', 'empleados', 'promociones', 'servicios', 'productos','num'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = auth()->user();
        $cajero = auth()->user()->id;
        $rol = $usuario->rol->nombre;

        //$empleado = auth()->user()->empleado->id;
        //dd($cajero);

        // Decodificar la cadena JSON de detalles
        $detalles = json_decode($request->detalles, true);

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio_id' => 'required|exists:servicios,id',
            'detalles' => 'required', // validar que 'detalles' esté presente
        ]);

        // Validar cada detalle individualmente
        foreach ($detalles as $detalle) {
            $detalle = (object)$detalle; // Convertir a objeto para una mejor manipulación
            $request->validate([
                'detalles.*.producto_id' => 'required|exists:productos,id',
                'detalles.*.cantidad' => 'required|integer|min:1',
            ]);
        }

        // Crear la venta
        if($usuario->rol->nombre === 'Cliente'){
            $fechaActual = Carbon::now();
            $venta = Venta::create([
                'id_cliente' => $request->cliente_id,
                'id_servicio' => $request->servicio_id,
                'fecha' => $fechaActual,
                'estado' => 'a',
                'id_promocion' => $request->has('promocion_id') ? $request->promocion_id : null,
                'id_empleado' => null,
                'total' => 0, // Inicializamos el total en 0
            ]);
        }

        if($usuario->rol->nombre === 'Cajero'){
            $fechaActual = Carbon::now();
            $venta = Venta::create([
                'id_cliente' => $request->cliente_id,
                'id_servicio' => $request->servicio_id,
                'fecha' => $fechaActual,
                'estado' => 'a',
                'id_promocion' => $request->has('promocion_id') ? $request->promocion_id : null,
                'id_empleado' => $cajero, // O puedes obtener el ID del empleado autenticado
                'total' => 0, // Inicializamos el total en 0
            ]);
        }
        if($usuario->rol->nombre === 'Administrador'){
            $fechaActual = Carbon::now();
            $venta = Venta::create([
                'id_cliente' => $request->cliente_id,
                'id_servicio' => $request->servicio_id,
                'fecha' => $fechaActual,
                'estado' => 'a',
                'id_promocion' => $request->has('promocion_id') ? $request->promocion_id : null,
                'id_empleado' => 1, // O puedes obtener el ID del empleado autenticado
                'total' => 0, // Inicializamos el total en 0
            ]);
        }

        // Validar que haya detalles
        if (empty($detalles)) {
            return redirect()->back()->withErrors(['detalles' => 'Se requiere agregar detalles para completar la venta.']);
        }

        // Procesar los detalles de la venta
        $total = 0;
        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle['producto_id']);
            $subtotal = $producto->precio * $detalle['cantidad'];
            $total += $subtotal;

            DetalleVenta::create([
                'id_venta' => $venta->id,
                'id_producto' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'estado' => 'a',
            ]);
        }

        if ($venta->id_promocion) {
            $promocion = Promocion::find($venta->id_promocion);
            $descuento = $promocion->descuento;
            $totalConDescuento = $total - ($total * ($descuento / 100));
        } else {
            $totalConDescuento = $total;
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $totalConDescuento]);

        return redirect()->route('venta.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

        // Cambiar el estado de la venta a 'inactivo'
        $venta->update(['estado' => 'i']);

        // Cambiar el estado de todos los detalles de la venta a 'inactivo'
        DetalleVenta::where('id_venta', $id)->update(['estado' => 'i']);

        // Redirigir a la lista de ventas con un mensaje de éxito
        return redirect()->route('venta.index')->with('success', 'Venta eliminada correctamente.');
    }

    public function detalles(Venta $venta)
{
    $html = '<div class="container">';
    $html .= '<h2>Venta #' . $venta->id . '</h2>';
    $html .= '<p>Cliente: ' . $venta->cliente->nombre . '</p>';
    // Verificar si existe el empleado
    if ($venta->empleado) {
        $html .= '<p>Empleado: ' . $venta->empleado->nombre . '</p>';
    }
    $html .= '<p>Fecha: ' . $venta->fecha . '</p>';
    
    $html .= '<h3>Detalles de Venta:</h3>';
    $html .= '<table class="table">';
    $html .= '<thead><tr><th>Producto</th><th>P/U</th><th>Cant</th><th>Subtotal</th></tr></thead>';
    $html .= '<tbody>';

    $totalSinDescuento = 0;
    foreach ($venta->detalleVentas as $detalle) {
        $precioUnitario = $detalle->producto->precio;
        $subtotal = $detalle->cantidad * $precioUnitario;
        $totalSinDescuento += $subtotal;
        $html .= '<tr>';
        $html .= '<td>' . $detalle->producto->nombre . '</td>';
        $html .= '<td>' . number_format($precioUnitario, 2) . '</td>';
        $html .= '<td>' . $detalle->cantidad . '</td>';
        $html .= '<td>' . number_format($subtotal, 2) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';

    // Calcular descuento aplicado si existe
    if ($venta->promocion) {
        $descuento = $venta->promocion->descuento;
        $montoDescuento = $totalSinDescuento * ($descuento / 100);
        $totalConDescuento = $totalSinDescuento - $montoDescuento;
        $html .= '<p>Descuento aplicado: ' . $descuento . '%</p>';
        $html .= '<p>Monto de descuento: ' . number_format($montoDescuento, 2) . '</p>';
    } else {
        $totalConDescuento = $totalSinDescuento;
    }

    $html .= '<h2><p>Total: ' . number_format($totalConDescuento, 2) . '</p></h2>';
    $html .= '</div>';

    return $html;
}


}
