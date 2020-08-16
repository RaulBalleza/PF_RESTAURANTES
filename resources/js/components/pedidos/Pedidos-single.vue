<template>
  <div class="PedidoSingle">
    <h1>Update Pedido</h1>

    <form @submit.prevent="updatePedido" v-if="loaded">
      <router-link to="/admin/pedidos">Back to pedidos</router-link>

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
        <select v-model="form.estado" class="form-control">
          <option value="Completado" selected="selected">Activo</option>
          <option value="Sin completar">Inactivo</option>
        </select>
        <has-error :form="form" field="estado"></has-error>
      </div>
      <div class="form-group" hidden>
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
        >{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
        <button @click.prevent="deletePedido">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
      </div>
    </form>

    <span v-else>Loading pedido...</span>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Pedido",
  components: { HasError },
  data: function () {
    return {
      loaded: false,
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
    this.getPedido();
  },
  methods: {
    getPedido: function (Pedido) {
      var that = this;
      this.form
        .get("/api/pedidos/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.loaded = true;
        })
        .catch(function (e) {
          if (e.response && e.response.status == 404) {
            that.$router.push("/404");
          }
        });
    },
    updatePedido: function () {
      var that = this;
      this.form
        .put("/api/pedidos/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
        });
    },
    deletePedido: function () {
      var that = this;
      this.form
        .delete("/api/pedidos/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.$router.push("/pedidos");
        });
    },
  },
};
</script>

<style lang="less">
.PedidoSingle {
  margin: 0 auto;
  width: 700px;
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
      .invalid-feedback {
        color: red;
        &::first-letter {
          text-transform: capitalize;
        }
      }
    }
  }
}
</style>