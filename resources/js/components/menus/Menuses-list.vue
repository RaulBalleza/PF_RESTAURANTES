<template>
      <div class="menuses">
        
        <div class="half">
          
          <h1>Create menus</h1>
          
          <form @submit.prevent="createMenus">
            
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"/>
            </div>
            <div class="form-group">
                  <label>id_restaurant</label>
                  <input type="number" v-model="form.id_restaurant"/>
                  <has-error :form="form" field="id_restaurant"></has-error>
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
          
          <h1>List menuses</h1>
          
          <ul v-if="menuses.length > 0">
            <li v-for="(menus,index) in menuses" :key="menus.id">
              
            <router-link :to="'/menus/'+menus.id">
              
              menus {{ index }}

              <button @click.prevent="deleteMenus(menus,index)" type="button" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
              
            </router-link>
              
            </li>
          </ul>
          
          <span v-else-if="!menuses">Loading...</span>
          <span v-else>No menuses exist</span>
          
        </div><!-- End 2nd half -->
        
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Menus',
  components: {HasError},
  data: function(){
    return {
      menuses : false,
      form: new Form({
          "id" : "",
          "id_restaurant" : "",
          "created_at" : "",
          "updated_at" : "",
      })
    }
  },
  created: function(){
    this.listMenuses();
  },
  methods: {
    listMenuses: function(){
      
      var that = this;
      this.form.get('/api/menuses').then(function(response){
        that.menuses = response.data;
      })
      
    },
    createMenus: function(){
      
      var that = this;
      this.form.post('/api/menuses').then(function(response){
        that.menuses.push(response.data);
      })
      
    },
    deleteMenus: function(menus, index){
      
      var that = this;
      this.form.delete('/api/menuses/'+menus.id).then(function(response){
        that.menuses.splice(index,1);
      })
      
    }
  }
}
</script>

<style lang="less">
.menuses{
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