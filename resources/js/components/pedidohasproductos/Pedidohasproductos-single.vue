<template>
      <div class="PedidohasproductoSingle">
        <h1>Update Pedidohasproducto</h1>
        
        <form @submit.prevent="updatePedidohasproducto" v-if="loaded">
          
          <router-link to="/admin/pedidohasproductos">Back to pedidohasproductos</router-link>
          
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"/>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.created_at"/>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.updated_at"/>
            </div>
      
          <div class="form-group">
              <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
              <button @click.prevent="deletePedidohasproducto">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </div>
        </form>
        
        <span v-else>Loading pedidohasproducto...</span>
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Pedidohasproducto',
  components: {HasError},
  data: function(){
    return {
      loaded: false,
      form: new Form({
          "id" : "",
          "created_at" : "",
          "updated_at" : "",
        
      })
    }
  },
  created: function(){
    this.getPedidohasproducto();
  },
  methods: {
    getPedidohasproducto: function(Pedidohasproducto){
      
      var that = this;
      this.form.get('/api/pedidohasproductos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.loaded = true;
      }).catch(function(e){
          if (e.response && e.response.status == 404) {
              that.$router.push('/404');
          }
      });
      
    },
    updatePedidohasproducto: function(){
      
      var that = this;
      this.form.put('/api/pedidohasproductos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
      })
      
    },
    deletePedidohasproducto: function(){
      
      var that = this;
      this.form.delete('/api/pedidohasproductos/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.$router.push('/pedidohasproductos');
      })
      
    }
  }
}
</script>

<style lang="less">
.PedidohasproductoSingle{
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