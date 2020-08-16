<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function getRestaurantMenu($codigo_restaurant)
    {
        $productos = DB::table('productos')->where('codigo_restaurant', $codigo_restaurant)->get();
        //var_dump($productos);
        return $productos;
    }
    public function getProductosPedido($codigo_pedido)
    {

        $productos = DB::table('productos')
            ->join('pedidohasproductos', function ($join) use (&$codigo_pedido) {
                $join->on('productos.id', '=', 'pedidohasproductos.id_producto')->where('pedidohasproductos.id_pedido', '=', $codigo_pedido);
            })
            ->get();

        return $productos;
    }
    public function getRestaurantPedidos($codigo_restaurant)
    {
        $pedidos = DB::table('pedidos')->where('codigo_restaurant', $codigo_restaurant)->get();
        //var_dump($productos);
        return $pedidos;
    }
}
