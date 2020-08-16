<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;

class ProductosController extends Controller
{
    public function get(Request $request, $id){
      return Productos::findOrFail($id);
    }
    
    public function list(Request $request){
      return Productos::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
        'codigo_restaurant' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
        'codigo_restaurant.required' => 'codigo_restaurant is a required field.',
        'codigo_restaurant.max' => 'codigo_restaurant can only be 255 characters.',
      ]);

        $productos = Productos::create($request->all());    
        return $productos;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'precio' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
        'codigo_restaurant' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'precio.required' => 'precio is a required field.',
        'precio.max' => 'precio can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
        'codigo_restaurant.required' => 'codigo_restaurant is a required field.',
        'codigo_restaurant.max' => 'codigo_restaurant can only be 255 characters.',
      ]);

        $productos = Productos::findOrFail($id);
        $input = $request->all();
        $productos->fill($input)->save();
        return $productos;
    }
    
    public function delete(Request $request, $id){
        $productos = Productos::findOrFail($id);
        $productos->delete();
    }
}
 ?>