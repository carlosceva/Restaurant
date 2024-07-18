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
use GuzzleHttp\Client; 

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

            $ventas = Venta::where('estado', 'a')->where('id_cliente', $idCliente)->whereNot('id_servicio',4)->get();

            return view('Pago.index', compact('pagos', 'num', 'ventas','usuario'));
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

            $clientes = Cliente::where('estado', 'a')->get();
            $ventas = Venta::where('estado', 'a')->whereNot('id_servicio',4)->get();
            $ventasJson = json_encode($ventas);  

            return view('Pago.index', compact('pagos', 'num', 'clientes', 'ventas','usuario','ventasJson'));
        }
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
        $cliente_id = Auth::user()->cliente->id;

        if($request->metodo == "Pago-Facil"){
            $loClient = new Client(); 
            $loUserAuth = $loClient->post( 
            'https://serviciostigomoney.pagofacil.com.bo/api/servicio/login', [ 
            'headers' =>    
            ['Accept' => 'application/json'], 
            'json' =>       
            array( 
            'TokenService' =>      
            "51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907", 
            'TokenSecret' =>      
            "9E7BC239DDC04F83B49FFDA5" 
            ) 
            ]); 
            $laTokenAuth = json_decode($loUserAuth->getBody()->getContents());
            //dd($laTokenAuth);
            if($laTokenAuth->error == 0){
                $loClient = new Client(); 
                $laPrepararPago = $loClient->post( 
                'https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagotigomoney', [ 
                    'headers' => [ 
                    'Accept' => 'application/json', 
                    'Authorization' => 'Bearer '. $laTokenAuth->values, 
                    ], 
                    'json' => array( 
                        "tcCommerceID"=> "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c", 
                        "tcNroPago"=> "20001", 
                        "tcNombreUsuario"=> "Jhon Doe", 
                        "tnCiNit"=> 7777777, 
                        "tnTelefono"=> 60000000, 
                        "tcCorreo"=> "micorreo@mail.com", 
                        "tcCodigoClienteEmpresa"=> "9", 
                        "tnMontoClienteEmpresa"=> "1", 
                        "tnMoneda"=> 2, 
                        "tcUrlCallBack"=> "http://mail.tecnoweb.org.bo/inf513/grupo12sc/Restaurant/public/confirmar-pago", 
                        "tcUrlReturn"=> "http://mail.tecnoweb.org.bo/inf513/grupo12sc/Restaurant/public/pago", 
                        "taPedidoDetalle"=> [ 
                            array(
                                "Serial"=> 1, 
                                "Producto"=> "Borrador", 
                                "Cantidad"=> 1, 
                                "Precio"=> "1", 
                                "Descuento"=> 0, 
                                "Total"=> "1" 
                            )
                        ] 
                    ) 
                ]); 
                $laRespuestaPrepararPago= json_decode($laPrepararPago->getBody()->getContents());
                dd($laRespuestaPrepararPago);
            }else{
                
            }
        }
         

        $pago = new Pago();
        $pago->id_cliente = $request->id_cliente; 
        $pago->id_venta = $request->id_venta;
        $pago->metodo_pago = $request->metodo;
        //$pago->transaccion = $request->metodo == "Pago-Facil" ? $laRespuestaPrepararPago->values : 0;
        $pago->estado = $request->metodo == "Pago-Facil" ? "p" : "a";
        $pago->save();

        return redirect()->route('pago.index')->with('success', 'Pago creado exitosamente.');
    }

    public function confirmarPago(Request $request){
        
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
