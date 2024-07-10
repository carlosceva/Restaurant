<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Producto;
use App\Models\Contador;
use App\Models\DetalleMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(4);

        $menus = Menu::with('detalleMenus.producto')->where('estado', 'a')->paginate(10);
        $productos = Producto::where('estado', 'a')->get();

        return view('Menu.index', compact('menus', 'productos','num'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detalles = json_decode($request->detalles, true);

        $validatedData = $request->validate([
            'descripcion' => 'required|string',
            'detalles' => 'required',
        ]);

        foreach ($detalles as $detalle) {
            $detalle = (object)$detalle;
            $request->validate([
                'detalles.*.producto_id' => 'required|exists:productos,id',
            ]);
        }

        $menu = Menu::create([
            'descripcion' => $request->descripcion,
            'estado' => 'a',
        ]);

        foreach ($detalles as $detalle) {
            DetalleMenu::create([
                'id_menu' => $menu->id,
                'id_producto' => $detalle['producto_id'],
                'estado' => 'a',
            ]);
        }

        return redirect()->route('menu.index')->with('success', 'Menú agregado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update(['estado' => 'i']);
        DetalleMenu::where('id_menu', $id)->update(['estado' => 'i']);

        return redirect()->route('menu.index')->with('success', 'Menú eliminado correctamente.');
    }

    public function detalles(Menu $menu)
    {
        $html = '<div class="container">';
        $html .= '<h2>Menú #' . $menu->id . '</h2>';
        $html .= '<p>Descripción: ' . $menu->descripcion . '</p>';

        $html .= '<h3>Detalles de Menú:</h3>';
        $html .= '<table class="table">';
        $html .= '<thead><tr><th>Producto</th><th>Precio</th></tr></thead>';
        $html .= '<tbody>';
        foreach ($menu->detalleMenus as $detalle) {
            $precio = $detalle->producto->precio;
            $html .= '<tr>';
            $html .= '<td>' . $detalle->producto->nombre . '</td>';
            $html .= '<td>' . number_format($precio, 2) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table></div>';

        return $html;
    }
}


