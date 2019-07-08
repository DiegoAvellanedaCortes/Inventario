<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario as Inventario;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventarios=Inventario::all();
        return \View::make('Inventario.lista',compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Inventario.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario= new Inventario;
        $inventario->producto=$request->producto;
        $inventario->cantidad=$request->cantidad;
        $inventario->numero_lote=$request->numero_lote;
        $inventario->fecha_vencimiento=$request->fecha;
        $inventario->precio=$request->precio;
        $inventario->save();
        return redirect('inventario'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,$cantidad)
    {   
        $arrayId=explode(",", $id);
        $arrayCant=explode(",", $cantidad);
        for ($i=0; $i < count($arrayId) ; $i++) { 
            $inventario= Inventario::find($arrayId[$i]);
            $inventario->cantidad=($inventario->cantidad-$arrayCant[$i]);  
            $inventario->save();
        }
        return redirect('compra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
