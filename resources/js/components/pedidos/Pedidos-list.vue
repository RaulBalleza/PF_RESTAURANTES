<template>
  <div class="pedidos">
    <div class="half">
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
        <div class="form-group">
          <label>codigo_restaurant</label>
          <input type="text" v-model="form.codigo_restaurant" maxlength="255" />
          <has-error :form="form" field="codigo_restaurant"></has-error>
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

    <div class="half">
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
        codigo_restaurant: "",
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
      this.form.get("/api/pedidos").then(function (response) {
        that.pedidos = response.data;
      });
    },
    createPedido: function () {
      var that = this;
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