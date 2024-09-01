<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return response()->json(Producto::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar datos
        $datos = $request->validate([
        'nombre'=>['required','string','max:100'],
        'descripcion'=>['nullable', 'string', 'max:255'],
        'precio'=>['required', 'integer', 'min:1000'],
        'stock'=>['required', 'integer', 'min:1'],
        ]);
        //guardar datos
        $producto=Producto::create($datos);

        //Respuesta al cliente
        return response()->json([
        'success'=> true,
        'message'=>'Producto creado exitosamente',
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //Validar datos
        $datos = $request->validate([
            'nombre'=>['required','string','max:100'],
            'descripcion'=>['nullable', 'string', 'max:255'],
            'precio'=>['required', 'integer', 'min:1000'],
            'stock'=>['required', 'integer', 'min:1'],
            ]);
            //actualizar datos
            $producto->update($datos);
    
            //Respuesta al cliente
            return response()->json([
            'success'=> true,
            'message'=>'Producto actualizado exitosamente',
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    //eliminar producto
   {
        $producto->delete();
    
        return response()->json([
            'success'=> true,
            'message'=>'Producto eliminado exitosamente',
            ],204);
    }
}
