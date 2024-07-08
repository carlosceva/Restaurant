<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Contador;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contar = new Contador();
        $num = $contar->contarModel(4);

        $menus = Menu::with('detalleMenus.producto')->get();
        return view('Menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $menu = Menu::create($request->all());
        return redirect()->route('menus.index')->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('Menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->update($request->all());
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->update(['estado' => 'i']);
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully');
    }
}
