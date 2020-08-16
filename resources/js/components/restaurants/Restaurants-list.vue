<template>
  <div class="container">
    <div>
      <div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">restaurants</h1>
        <p class="mb-4">Listado de los restaurants.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tabla de restaurants</h2>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#exampleModal"
            >Nuevo restaurant</button>
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
                    <th>Código</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
                <tbody v-if="restaurants.length > 0">
                  <tr v-for="(restaurant,index) in restaurants" :key="restaurant.id">
                    <td>
                      <router-link :to="'/admin/restaurant/'+restaurant.id">{{restaurant.id}}</router-link>
                    </td>
                    <td>{{restaurant.nombre}}</td>
                    <td>{{restaurant.codigo}}</td>
                    <td>
                      <div class="row">
                        <router-link :to="'/admin/'+restaurant.codigo+'/menu'">
                          <button
                            class="btn btn-success btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Ver menú'}}
                          </button>
                        </router-link>
                        <router-link :to="'/admin/'+restaurant.codigo+'/pedidos'">
                          <button
                            class="btn btn-success btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Ver pedidos'}}
                          </button>
                        </router-link>
                      </div>
                      <div class="row">
                        <button
                          @click.prevent="deleteRestaurant(restaurant,index)"
                          class="btn btn-danger btn-sm"
                          type="button"
                          :disabled="form.busy"
                          name="button"
                        >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
                        <router-link :to="'/admin/restaurant/'+restaurant.id">
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
      <h1>Create restaurant</h1>

      <form @submit.prevent="createRestaurant">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
          <label>nombre</label>
          <input type="text" v-model="form.nombre" maxlength="255" />
          <has-error :form="form" field="nombre"></has-error>
        </div>
        <div class="form-group">
          <label>codigo</label>
          <input type="text" v-model="form.codigo" maxlength="255" />
          <has-error :form="form" field="codigo"></has-error>
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
      <h1>List restaurants</h1>

      <ul v-if="restaurants.length > 0">
        <li v-for="(restaurant,index) in restaurants" :key="restaurant.id">
          <router-link :to="'/admin/restaurant/'+restaurant.id">
            restaurant {{ index }}
            <button
              @click.prevent="deleteRestaurant(restaurant,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!restaurants">Loading...</span>
      <span v-else>No restaurants exist</span>
    </div>
    <!-- End 2nd half -->
    <div class="restaurants">
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
            <form @submit.prevent="createRestaurant">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" v-model="form.id" />
                </div>
                <div class="form-group">
                  <label>nombre</label>
                  <input type="text" v-model="form.nombre" maxlength="255" />
                  <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>codigo</label>
                  <input type="text" v-model="form.codigo" maxlength="255" />
                  <has-error :form="form" field="codigo"></has-error>
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
  name: "Restaurant",
  components: { HasError },
  data: function () {
    return {
      restaurants: false,
      form: new Form({
        id: "",
        nombre: "",
        codigo: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listRestaurants();
  },
  methods: {
    listRestaurants: function () {
      var that = this;
      this.form.get("/api/restaurants").then(function (response) {
        that.restaurants = response.data;
      });
    },
    createRestaurant: function () {
      var that = this;
      this.form.post("/api/restaurants").then(function (response) {
        that.restaurants.push(response.data);
      });
    },
    deleteRestaurant: function (restaurant, index) {
      var that = this;
      this.form
        .delete("/api/restaurants/" + restaurant.id)
        .then(function (response) {
          that.restaurants.splice(index, 1);
        });
    },
  },
};
</script>

<style lang="less">
.restaurants {
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