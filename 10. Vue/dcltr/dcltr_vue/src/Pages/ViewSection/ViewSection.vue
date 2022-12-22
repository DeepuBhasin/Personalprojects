<template>
  <div class="content-wrapper" style="min-height: 242px">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/">Home</router-link>
              </li>
              <li class="breadcrumb-item active">
                   <router-link to="viewsection">Section Management</router-link>
            </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <Card>
        <template v-slot:title>
            <h3 class="card-title">All Section</h3>
            <router-link :to="{name:'CreateSection'}" class="btn btn-primary btn-sm pull-right" >Create Section</router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
                </div>
            </div>
        </template>
    </Card>
  </div>
</template>

<script>
import Card from '@/components/Card/Card.vue'
import ITable from '../../components/ITable/ITable.vue'
import ViewButton from '@/Pages/ViewSection/ViewButton.vue'
import EditButton from '@/Pages/ViewSection/EditButton.vue';
import DeleteButton from '@/Pages/ViewSection/DeleteButton.vue';
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
export default {
  name : 'ViewRoles',
        components: {
        Card,
        ITable,
        ViewButton,
        DeleteButton,
        EditButton

    },
    computed:{
        ...mapState('modal',["status","id"]),
        ...mapState('helpers',["catCurrentPage","actionTaken"])
    },
    watch: {
        $route (to, from){
                console.log(to, from);
                this.isChild = 'id' in this.$route.params
                //this.refresh(1)
        },
        catCurrentPage: function (catCurrentPageNew, catCurrentPageOld) {
            if(typeof catCurrentPageNew != "undefined")
            console.log("catCurrentPageNew",catCurrentPageNew);
            //this.refresh(catCurrentPageNew)

            
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },
        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(1);
            }
        }
    },
    methods:{
        addEditCat(){
            let _id = this.isChild?this.$route.params.id:0;
            this.closeModal({status:true, parent_id: _id});
        },
    },
    mounted:function(){
        this.refresh(1);
        // api.get('admin/form/list').then(data=>data.data).then(response=>{ 
        //     console.log("data",response); 
        //     let rows = response.data.subcategories.data.map(function(obj){
        //         return {...obj, "actions":[]}
        //     })
        //     this.meta = response.data.subcategories
            
        //     this.rows = rows;
        //     //this.refresh(1);
        // })
        
    },
    inject:["show","hide"],
    data(){
        return {
            isChild:  'id' in this.$route.params,
            refresh: function(pageIndex){
                api.get(`admin/section?page=${this.planCurrentPage}`).then(data=>{
                        return data.data;
                    }).then(response=>{ 
                    // response.data = response.data.filter(obj=>obj.id!==1);
                    let rows = response.data.map(function(obj){
                        return {...obj,"actions":[{ViewButton,props:{id:obj.id}},{EditButton,props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                    
                    })
                    this.meta = response.meta
                    this.rows = rows;
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped",'capital'],
            columns: [
                {'title':'ID', key:'id'},
                {'title':'Name', key:'name'},
                {'title':'Actions', key:'actions'},
            ],
            rows:[],
            meta:{}
        }
    },
    created () {

    }
}
</script>

