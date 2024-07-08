<?php

namespace App\Http\Controllers;

use App\Models\DetalleMenu;
use Illuminate\Http\Request;
use App\Models\Producto;

class DetalleMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($menuId)
    {
        $detalles = DetalleMenu::where('id_menu', $menuId)->with('producto')->get();
        return view('detalles.index', compact('detalles', 'menuId'));
    }

    public function create($menuId)
    {
        $productos = Producto::all();
        return view('detalles.create', compact('menuId', 'productos'));
    }

    public function store(Request $request, $menuId)
    {
        $detalle = new DetalleMenu($request->all());
        $detalle->id_menu = $menuId;
        $detalle->save();
        return redirect()->route('menus.detalles.index', $menuId)->with('success', 'Detalle created successfully');
    }

    public function edit($menuId, $id)
    {
        $detalle = DetalleMenu::find($id);
        $productos = Producto::all();
        return view('detalles.edit', compact('detalle', 'menuId', 'productos'));
    }

    public function update(Request $request, $menuId, $id)
    {
        $detalle = DetalleMenu::find($id);
        $detalle->update($request->all());
        return redirect()->route('menus.detalles.index', $menuId)->with('success', 'Detalle updated successfully');
    }

    public function destroy($menuId, $id)
    {
        $detalle = DetalleMenu::find($id);
        $detalle->delete();
        return redirect()->route('menus.detalles.index', $menuId)->with('success', 'Detalle deleted successfully');
    }
}
