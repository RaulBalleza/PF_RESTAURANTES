<template>
  <div class="container">
    <div>
      <div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">pedidos</h1>
        <p class="mb-4">Listado de los pedidos.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tabla de pedidos</h2>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#exampleModal"
            >Nuevo pedido</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Mesa</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Mesa</th>
                    <th>Total</th>
                    <th>Estado</th>
                  </tr>
                </tfoot>
                <tbody v-if="pedidos.length > 0">
                  <tr v-for="(pedido,index) in pedidos" :key="pedido.id">
                    <td>
                      <router-link :to="'/admin/pedido/'+pedido.id">{{pedido.id}}</router-link>
                    </td>
                    <td>{{pedido.mesa}}</td>
                    <td>$ {{pedido.total}}</td>
                    <td>{{pedido.estado}}</td>
                    <td>
                      <div class="row">
                        <router-link :to="'/admin/pedido/'+pedido.id+'/productos'">
                          <button
                            class="btn btn-success btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Ver productos'}}
                          </button>
                        </router-link>
                      </div>
                      <div class="row">
                        <button
                          @click.prevent="deletepedido(pedido,index)"
                          class="btn btn-danger btn-sm"
                          type="button"
                          :disabled="form.busy"
                          name="button"
                        >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
                        <router-link :to="'/admin/pedido/'+pedido.id">
                          <button
                            class="btn btn-primary btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Editar'}}
                          </button>
                        </router-link>
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
      <h1>Create pedido</h1>

      <form @submit.prevent="createPedido">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
          <label>mesa</label>
          <input type="number" v-model="form.mesa" />
          <has-error :form="form" field="mesa"></has-error>
        </div>
        <div class="form-group">
          <label>total</label>
          <input type="number" v-model="form.total" />
          <has-error :form="form" field="total"></has-error>
        </div>
        <div class="form-group">
          <label>estado</label>
          <input type="text" v-model="form.estado" maxlength="255" />
          <has-error :form="form" field="estado"></has-error>
        </div>
        <div class="form-group" hidden>
          <label>codigo_pedido</label>
          <input type="text" v-model="form.codigo_pedido" maxlength="255" />
          <has-error :form="form" field="codigo_pedido"></has-error>
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
      <h1>List pedidos</h1>

      <ul v-if="pedidos.length > 0">
        <li v-for="(pedido,index) in pedidos" :key="pedido.id">
          <router-link :to="'/admin/pedido/'+pedido.id">
            pedido {{ index }}
            <button
              @click.prevent="deletePedido(pedido,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!pedidos">Loading...</span>
      <span v-else>No pedidos exist</span>
    </div>
    <!-- End 2nd half -->
    <div class="pedidos">
      <!-- Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="createPedido">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" v-model="form.id" />
                </div>
                <div class="form-group">
                  <label>mesa</label>
                  <input type="number" v-model="form.mesa" />
                  <has-error :form="form" field="mesa"></has-error>
                </div>
                <div class="form-group">
                  <label>total</label>
                  <input type="number" v-model="form.total" />
                  <has-error :form="form" field="total"></has-error>
                </div>
                <div class="form-group">
                  <label>estado</label>
                  <input type="text" v-model="form.estado" maxlength="255" />
                  <has-error :form="form" field="estado"></has-error>
                </div>
                <div class="form-group" hidden>
                  <label>codigo_pedido</label>
                  <input type="text" v-model="form.codigo_pedido" maxlength="255" />
                  <has-error :form="form" field="codigo_pedido"></has-error>
                </div>
                <div class="form-group">
                  <input type="hidden" v-model="form.created_at" />
                </div>
                <div class="form-group">
                  <input type="hidden" v-model="form.updated_at" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button
                  class="btn btn-success btn-sm"
                  type="submit"
                  :disabled="form.busy"
                  name="button"
                >{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Pedido",
  components: { HasError },
  data: function () {
    return {
      pedidos: false,
      form: new Form({
        id: "",
        mesa: "",
        total: "",
        estado: "",
        codigo_pedido: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listPedidos();
  },
  methods: {
    listPedidos: function () {
      var that = this;
      this.form
        .get("/api/" + this.$route.params.codigo + "/pedidos")
        .then(function (response) {
          that.pedidos = response.data;
        });
    },
    createPedido: function () {
      var that = this;
      this.form.codigo_pedido = this.$route.params.codigo;
      this.form.post("/api/pedidos").then(function (response) {
        that.pedidos.push(response.data);
      });
    },
    deletePedido: function (pedido, index) {
      var that = this;
      this.form.delete("/api/pedidos/" + pedido.id).then(function (response) {
        that.pedidos.splice(index, 1);
      });
    },
  },
};
</script>

<style lang="less">
.pedidos {
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