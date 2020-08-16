<template>
      <div class="ProductoSingle">
        <h1>Update Producto</h1>
        
        <form @submit.prevent="updateProducto" v-if="loaded">
          
          <router-link to="/admin/productos">Back to productos</router-link>
          
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"/>
            </div>
            <div class="form-group">
                  <label>nombre</label>
                  <input type="text" v-model="form.nombre"  maxlength="255" />
                  <has-error :form="form" field="nombre"></has-error>
            </div>
            <div class="form-group">
                  <label>precio</label>
                  <input type="number" v-model="form.precio"/>
                  <has-error :form="form" field="precio"></has-error>
            </div>
            <div class="form-group">
                  <label>estado</label>
                  <input type="text" v-model="form.estado"  maxlength="255" />
                  <has-error :form="form" field="estado"></has-error>
            </div>
            <div class="form-group">
                  <label>codigo_restaurant</label>
                  <input type="text" v-model="form.codigo_restaurant"  maxlength="255" />
                  <has-error :form="form" field="codigo_restaurant"></has-error>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.created_at"/>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.updated_at"/>
            </div>
      
          <div class="form-group">
              <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
              <button @click.prevent="deleteProducto">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </div>
        </form>
        
        <span v-else>Loading producto...</span>
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Producto',
  components: {HasError},
  data: function(){
    return {
      loaded: false,
      form: new Form({
          "id" : "",
          "nombre" : "",
          "precio" : "",
          "estado" : "",
          "codigo_restaurant" : "",
          "created_at" : "",
          "updated_at" : "",
        
      })
    }
  },
  created: function(){
    this.getProducto();
  },
  methods: {
    getProducto: function(Producto){
      
      var that = this;
      this.form.get('/api/productos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.loaded = true;
      }).catch(function(e){
          if (e.response && e.response.status == 404) {
              that.$router.push('/404');
          }
      });
      
    },
    updateProducto: function(){
      
      var that = this;
      this.form.put('/api/productos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
      })
      
    },
    deleteProducto: function(){
      
      var that = this;
      this.form.delete('/api/productos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.$router.push('/productos');
      })
      
    }
  }
}
</script>

<style lang="less">
.ProductoSingle{
  margin:0 auto;
  width:700px;
  form{
    .form-group{
      margin-bottom:20px;
      label{
        display:block;
        margin-bottom:5px;
        text-transform: capitalize;
      }
      input[type="text"],input[type="number"],textarea{
        width:100%;
        max-width:100%;
        min-width:100%;
        padding:10px;
        border-radius:3px;
        border:1px solid silver;
        font-size:1rem;
        &:focus{
          outline:0;
          border-color:blue;
        }
      }
      .button{
        appearance: none;
        background: #3bdfd9;
        font-size: 1rem;
        border: 0px;
        padding: 10px 20px;
        border-radius: 3px;
        font-weight: bold;
        &:hover{
          cursor:pointer;
          background: darken(#3bdfd9,10);
        }
      }
      .invalid-feedback{
        color:red;
        &::first-letter{
          text-transform:capitalize;
        }
      }
    }
  }
}
</style>