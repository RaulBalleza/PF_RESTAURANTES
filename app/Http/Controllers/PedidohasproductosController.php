<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidohasproductos;

class PedidohasproductosController extends Controller
{
    public function get(Request $request, $id){
      return Pedidohasproductos::findOrFail($id);
    }
    
    public function list(Request $request){
      return Pedidohasproductos::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
      ],[
      ]);

        $pedidohasproductos = Pedidohasproductos::create($request->all());    
        return $pedidohasproductos;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
      ],[
      ]);

        $pedidohasproductos = Pedidohasproductos::findOrFail($id);
        $input = $request->all();
        $pedidohasproductos->fill($input)->save();
        return $pedidohasproductos;
    }
    
    public function delete(Request $request, $id){
        $pedidohasproductos = Pedidohasproductos::findOrFail($id);
        $pedidohasproductos->delete();
    }
}
 ?>