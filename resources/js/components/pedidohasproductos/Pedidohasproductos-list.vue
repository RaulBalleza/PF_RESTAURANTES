<template>
      <div class="pedidohasproductos">
        
        <div class="half">
          
          <h1>Create pedidohasproducto</h1>
          
          <form @submit.prevent="createPedidohasproducto">
            
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
                <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
            </div>
          </form>
          
        </div><!-- End first half -->
        
        <div class="half">
          
          <h1>List pedidohasproductos</h1>
          
          <ul v-if="pedidohasproductos.length > 0">
            <li v-for="(pedidohasproducto,index) in pedidohasproductos" :key="pedidohasproducto.id">
              
            <router-link :to="'/admin/pedidohasproducto/'+pedidohasproducto.id">
              
              pedidohasproducto {{ index }}

              <button @click.prevent="deletePedidohasproducto(pedidohasproducto,index)" type="button" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
              
            </router-link>
              
            </li>
          </ul>
          
          <span v-else-if="!pedidohasproductos">Loading...</span>
          <span v-else>No pedidohasproductos exist</span>
          
        </div><!-- End 2nd half -->
        
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Pedidohasproducto',
  components: {HasError},
  data: function(){
    return {
      pedidohasproductos : false,
      form: new Form({
          "id" : "",
          "created_at" : "",
          "updated_at" : "",
      })
    }
  },
  created: function(){
    this.listPedidohasproductos();
  },
  methods: {
    listPedidohasproductos: function(){
      
      var that = this;
      this.form.get('/api/pedidohasproductos').then(function(response){
        that.pedidohasproductos = response.data;
      })
      
    },
    createPedidohasproducto: function(){
      
      var that = this;
      this.form.post('/api/pedidohasproductos').then(function(response){
        that.pedidohasproductos.push(response.data);
      })
      
    },
    deletePedidohasproducto: function(pedidohasproducto, index){
      
      var that = this;
      this.form.delete('/api/pedidohasproductos/'+pedidohasproducto.id).then(function(response){
        that.pedidohasproductos.splice(index,1);
      })
      
    }
  }
}
</script>

<style lang="less">
.pedidohasproductos{
    margin:0 auto;
    width:700px;
    display:flex;
    .half{
      flex:1;
      &:first-of-type{
        margin-right:20px;
      }
    }
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
        .invalid-feedback{
          color:red;
          &::first-letter{
            text-transform:capitalize;
          }
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
    }
}
</style>