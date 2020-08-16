<template>
  <div class="container">
    <div>
      <div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">productos</h1>
        <p class="mb-4">Listado de los productos.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tabla de productos</h2>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#exampleModal"
            >Nuevo producto</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>

                    <th>Acciones</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                  </tr>
                </tfoot>
                <tbody v-if="productos.length > 0">
                  <tr v-for="(producto,index) in productos" :key="producto.id">
                    <td>
                      <router-link :to="'/admin/producto/'+producto.id">{{producto.id}}</router-link>
                    </td>
                    <td>{{producto.nombre}}</td>
                    <td>{{producto.cantidad}}</td>
                    <td>$ {{producto.precio * producto.cantidad}}</td>
                    <td>
                      <div class="row">
                        <button
                          @click.prevent="deleteproducto(producto,index)"
                          class="btn btn-danger btn-sm"
                          type="button"
                          :disabled="form.busy"
                          name="button"
                        >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="half" hidden>
      <h1>Create producto</h1>

      <form @submit.prevent="createProducto">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
          <label>nombre</label>
          <input type="text" v-model="form.nombre" maxlength="255" />
          <has-error :form="form" field="nombre"></has-error>
        </div>
        <div class="form-group">
          <label>precio</label>
          <input type="number" v-model="form.precio" />
          <has-error :form="form" field="precio"></has-error>
        </div>
        <div class="form-group" hidden>
          <label>codigo_producto</label>
          <input type="text" v-model="form.codigo_producto" maxlength="255" />
          <has-error :form="form" field="codigo_producto"></has-error>
        </div>
        <div class="form-group">
          <input type="hidden" v-model="form.created_at" />
        </div>
        <div class="form-group">
          <input type="hidden" v-model="form.updated_at" />
        </div>

        <div class="form-group">
          <button
            class="button"
            type="submit"
            :disabled="form.busy"
            name="button"
          >{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
        </div>
      </form>
    </div>
    <!-- End first half -->

    <div class="half" hidden>
      <h1>List productos</h1>

      <ul v-if="productos.length > 0">
        <li v-for="(producto,index) in productos" :key="producto.id">
          <router-link :to="'/admin/producto/'+producto.id">
            producto {{ index }}
            <button
              @click.prevent="deleteProducto(producto,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!productos">Loading...</span>
      <span v-else>No productos exist</span>
    </div>
    <!-- End 2nd half -->
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Producto",
  components: { HasError },
  data: function () {
    return {
      productos: false,
      form: new Form({
        id: "",
        nombre: "",
        precio: "",
        estado: "Activo",
        codigo_producto: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listProductos();
    //console.log(this.$route.params.codigo);
  },
  methods: {
    listProductos: function () {
      var that = this;
      this.form
        .get("/api/pedido/" + this.$route.params.id + "/productos")
        .then(function (response) {
          that.productos = response.data;
        });
    },
    createProducto: function () {
      var that = this;
      this.form.codigo_producto = this.$route.params.codigo;

      this.form.post("/api/productos").then(function (response) {
        that.productos.push(response.data);
      });
    },
    deleteProducto: function (producto, index) {
      var that = this;
      this.form
        .delete("/api/productos/" + producto.id)
        .then(function (response) {
          that.productos.splice(index, 1);
        });
    },
  },
};
</script>

<style lang="less">
.productos {
  margin: 0 auto;
  width: 700px;
  display: flex;
  .half {
    flex: 1;
    &:first-of-type {
      margin-right: 20px;
    }
  }
  form {
    .form-group {
      margin-bottom: 20px;
      label {
        display: block;
        margin-bottom: 5px;
        text-transform: capitalize;
      }
      input[type="text"],
      input[type="number"],
      textarea {
        width: 100%;
        max-width: 100%;
        min-width: 100%;
        padding: 10px;
        border-radius: 3px;
        border: 1px solid silver;
        font-size: 1rem;
        &:focus {
          outline: 0;
          border-color: blue;
        }
      }
      .invalid-feedback {
        color: red;
        &::first-letter {
          text-transform: capitalize;
        }
      }
    }
    .button {
      appearance: none;
      background: #3bdfd9;
      font-size: 1rem;
      border: 0px;
      padding: 10px 20px;
      border-radius: 3px;
      font-weight: bold;
      &:hover {
        cursor: pointer;
        background: darken(#3bdfd9, 10);
      }
    }
  }
}
</style>