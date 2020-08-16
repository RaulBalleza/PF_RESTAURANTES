<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;

class MenusController extends Controller
{
    public function get(Request $request, $id){
      return Menus::findOrFail($id);
    }
    
    public function list(Request $request){
      return Menus::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_restaurant' => 'required |max:20 ',
      ],[
        'id_restaurant.required' => 'id_restaurant is a required field.',
        'id_restaurant.max' => 'id_restaurant can only be 20 characters.',
      ]);

        $menus = Menus::create($request->all());    
        return $menus;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_restaurant' => 'required |max:20 ',
      ],[
        'id_restaurant.required' => 'id_restaurant is a required field.',
        'id_restaurant.max' => 'id_restaurant can only be 20 characters.',
      ]);

        $menus = Menus::findOrFail($id);
        $input = $request->all();
        $menus->fill($input)->save();
        return $menus;
    }
    
    public function delete(Request $request, $id){
        $menus = Menus::findOrFail($id);
        $menus->delete();
    }
}
 ?>