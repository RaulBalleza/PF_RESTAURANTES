<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menuses;

class MenusesController extends Controller
{
    public function get(Request $request, $id){
      return Menuses::findOrFail($id);
    }
    
    public function list(Request $request){
      return Menuses::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'id_restaurant' => 'required |max:20 ',
      ],[
        'id_restaurant.required' => 'id_restaurant is a required field.',
        'id_restaurant.max' => 'id_restaurant can only be 20 characters.',
      ]);

        $menuses = Menuses::create($request->all());    
        return $menuses;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'id_restaurant' => 'required |max:20 ',
      ],[
        'id_restaurant.required' => 'id_restaurant is a required field.',
        'id_restaurant.max' => 'id_restaurant can only be 20 characters.',
      ]);

        $menuses = Menuses::findOrFail($id);
        $input = $request->all();
        $menuses->fill($input)->save();
        return $menuses;
    }
    
    public function delete(Request $request, $id){
        $menuses = Menuses::findOrFail($id);
        $menuses->delete();
    }
}
 ?>