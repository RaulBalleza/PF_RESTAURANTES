<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurants;

class RestaurantsController extends Controller
{
    public function get(Request $request, $id){
      return Restaurants::findOrFail($id);
    }
    
    public function list(Request $request){
      return Restaurants::get();
    }
    
    public function create(Request $request){
        
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'codigo' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'codigo.required' => 'codigo is a required field.',
        'codigo.max' => 'codigo can only be 255 characters.',
      ]);

        $restaurants = Restaurants::create($request->all());    
        return $restaurants;
    }
    
    public function update(Request $request, $id){
      
      $validatedData = $request->validate([
        'nombre' => 'required |max:255 ',
        'codigo' => 'required |max:255 ',
      ],[
        'nombre.required' => 'nombre is a required field.',
        'nombre.max' => 'nombre can only be 255 characters.',
        'codigo.required' => 'codigo is a required field.',
        'codigo.max' => 'codigo can only be 255 characters.',
      ]);

        $restaurants = Restaurants::findOrFail($id);
        $input = $request->all();
        $restaurants->fill($input)->save();
        return $restaurants;
    }
    
    public function delete(Request $request, $id){
        $restaurants = Restaurants::findOrFail($id);
        $restaurants->delete();
    }
}
 ?>