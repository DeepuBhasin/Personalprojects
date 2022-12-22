<template>
<SectionHeader header="Form Management" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/formbuilder">Form Management</router-link>
        </li>
    </template>    
    <template v-slot:title>
            <h3 class="card-title">Form Management </h3>
            <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add">Create Form </a></router-link>
    </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                     <span v-if="pagePermission.edit || pagePermission.delete" ></span>
                <span v-else>{{columns[2]=''}}</span>  
                    <!-- <h1>Category Management</h1> -->
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" :section="'form'"></ITable>
                </div>
            </div>
        </template>
</SectionHeader>
</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import DeleteButton from '@/Pages/FormBuilder/DeleteButton';
import EditButton from '@/Pages/FormBuilder/EditButton';
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
export default {
        components: {
        ITable,
        Modal
    },
    computed:{
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.forms_management?.includes('page')  ? true : false,
                      add :  state.permission?.forms_management?.includes('add')  ? true : false,

                      edit :  state.permission?.forms_management?.includes('edit')  ? true : false,
                      delete :  state.permission?.forms_management?.includes('delete')  ? true : false,
                  }
              }
          }),
        ...mapState('modal',["status","id"]),
        ...mapState('helpers',["formCurrentPage","actionTaken"])
    },
    watch: {
        $route (to, from){
                console.log(to, from);
                this.isChild = 'id' in this.$route.params
                //this.refresh(1)
        },
        formCurrentPage: function (formCurrentPageNew, formCurrentPageOld) {
            if(typeof formCurrentPageNew != "undefined")
            console.log("formCurrentPageNew",formCurrentPageNew);
            this.refresh(formCurrentPageNew)

            
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },
        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(1);
                // api.get('admin/category/getScrapCategories?page=1').then(data=>data.data).then(response=>{ 
                //     console.log("data",response); 
                //     let rows = response.data.map(function(obj){
                //         return {...obj,"actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                //     })
                //     this.meta = response.meta
                //     this.rows = rows;
                // })
            }
        }
    },
    methods:{
        checkPermission(){
            return this.pagePermission.page;
        },
        ...mapActions('modal',{"closeModal":"toggleModal"}),
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
                console.log("Refresh Called..", pageIndex);
                api.get('admin/form/list?page='+pageIndex).then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    let rows = response.data.map(function(obj){
                        return {...obj, "actions":[{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}}]}
                    })
                    this.meta = response.meta
                    
                    this.rows = rows;
                    //this.refresh(1);
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped"],
            columns: [
                {'title':'ID', key:'id'},
                {'title':'Title', key:'title'},
                
                {'title':'Actions', key:'actions'},
            ],
            rows:[
                // {
                //     'id':'1',
                //     'title':'Electronics',
                //     'subcategories':'2',
                //     'actions':[{EditButton, props:{id:1}}]
                // }
            ],
            meta:{}
        }
    },
      created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>

