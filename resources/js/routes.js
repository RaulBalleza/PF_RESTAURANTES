import ExampleComponent from './components/ExampleComponent.vue';
//Restaurants View
import Restaurants from './components/restaurants/Restaurants-list.vue';
import Restaurant from './components/restaurants/Restaurants-single.vue';

//Menus View
import Menus from './components/menus/Menuses-list.vue';
import Menu from './components/menus/Menuses-single.vue';
import RestaurantMenu from './components/productos/Productos-restaurant.vue';

//Pedidos View
import Pedidos from './components/pedidos/Pedidos-list.vue';
import Pedido from './components/pedidos/Pedidos-single.vue';
import RestaurantPedidos from './components/pedidos/Pedidos-restaurant.vue';

//Productos View
import Productos from './components/productos/Productos-list.vue';
import Producto from './components/productos/Productos-single.vue';
import ProductosPedido from './components/pedidos/Productos-pedido.vue';


export const routes = [
    {
        name: 'example',
        path: '/example',
        component: ExampleComponent
    },
    {
        name: 'restaurants',
        path: '/admin/restaurants',
        component: Restaurants
    },
    {
        name: 'restaurant',
        path: '/admin/restaurant/:id',
        component: Restaurant
    },
    {
        name: 'menus',
        path: '/admin/menus',
        component: Menus
    },
    {
        name: 'restaurant-menu',
        path: '/admin/:codigo/menu',
        component: RestaurantMenu
    },
    {
        name: 'restaurant-pedidos',
        path: '/admin/:codigo/pedidos',
        component: RestaurantPedidos
    },
    {
        name: 'productos-pedido',
        path: '/admin/pedido/:id/productos',
        component: ProductosPedido
    },
    {
        name: 'menu',
        path: '/admin/menu/:id',
        component: Menu
    },
    {
        name: 'pedidos',
        path: '/admin/pedidos',
        component: Pedidos
    },
    {
        name: 'pedido',
        path: '/admin/pedido/:id',
        component: Pedido
    },
    {
        name: 'productos',
        path: '/admin/productos',
        component: Productos
    },
    {
        name: 'producto',
        path: '/admin/producto/:id',
        component: Producto
    },
];

export default { routes };
