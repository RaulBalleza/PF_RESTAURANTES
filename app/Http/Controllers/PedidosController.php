<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;

class PedidosController extends Controller
{
    public function get(Request $request, $id){
      return Pedidos::findOrFail($id);
    }
    
    public function list(Request $request){
      return Pedidos::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'mesa' => 'required |max:11 ',
        'total' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
        'codigo_restaurant' => 'required |max:255 ',
      ],[
        'mesa.required' => 'mesa is a required field.',
        'mesa.max' => 'mesa can only be 11 characters.',
        'total.required' => 'total is a required field.',
        'total.max' => 'total can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
        'codigo_restaurant.required' => 'codigo_restaurant is a required field.',
        'codigo_restaurant.max' => 'codigo_restaurant can only be 255 characters.',
      ]);

        $pedidos = Pedidos::create($request->all());    
        return $pedidos;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'mesa' => 'required |max:11 ',
        'total' => 'required |max:8 ',
        'estado' => 'required |max:255 ',
        'codigo_restaurant' => 'required |max:255 ',
      ],[
        'mesa.required' => 'mesa is a required field.',
        'mesa.max' => 'mesa can only be 11 characters.',
        'total.required' => 'total is a required field.',
        'total.max' => 'total can only be 8 characters.',
        'estado.required' => 'estado is a required field.',
        'estado.max' => 'estado can only be 255 characters.',
        'codigo_restaurant.required' => 'codigo_restaurant is a required field.',
        'codigo_restaurant.max' => 'codigo_restaurant can only be 255 characters.',
      ]);

        $pedidos = Pedidos::findOrFail($id);
        $input = $request->all();
        $pedidos->fill($input)->save();
        return $pedidos;
    }
    
    public function delete(Request $request, $id){
        $pedidos = Pedidos::findOrFail($id);
        $pedidos->delete();
    }
}
 ?>