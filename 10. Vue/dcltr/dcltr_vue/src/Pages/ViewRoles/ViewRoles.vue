<template>
    <SectionHeader header="Permission Group" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                  <router-link to="/viewroles">Permission Group</router-link>
                </li>
         </template>
        <template v-slot:title>
            <h3 class="card-title">Permission Group</h3>
            <router-link :to="{name:'AddRoles'}" class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add">Create Permission</router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
                </div>
            </div>
        </template>
    </SectionHeader>
</template>

<script>
import ITable from '../../components/ITable/ITable.vue'
import EditButton from '@/Pages/ViewRoles/EditButton.vue';
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'
export default {
  name : 'ViewRoles',
        components: {
        ITable,
        EditButton
    },
     computed:{
         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.permission_group?.includes('page')  ? true : false,
                      add :  state.permission?.permission_group?.includes('add')  ? true : false,
                  }
              }
          }),
        ...mapState('modal',["status" ,"id", "type"]),
        ...mapState('helpers',["planCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])
    },
    watch: {
        status(to, from){
                console.log(to, from);
                //this.isChild = 'id' in this.$route.params
                //this.refresh(to)
        },
        type(to, from){
                console.log('Modal Type-->',to, from);
                //this.isChild = 'id' in this.$route.params
                //this.refresh(to)
        },

        statusToken(to, from){
                console.log("statusToken",to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(this.userType, this.planCurrentPage)
        },
        planCurrentPage: function (to, from) {
            if(typeof to != "undefined")
            this.refresh(this.userType, to)
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, newState.type, 2000)
                if(newState.type=='success'){
                    this.closeModal({status:false})
                }
                this.refresh(this.userType, this.planCurrentPage);
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
        updateUserType(e){
            console.log("this is user type",e, this.userType)
        }
    },
    mounted:function(){
        this.refresh(this.cat_id, this.planCurrentPage);
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
                api.get(`admin/role?page=${this.planCurrentPage}`).then(data=>{
                        return data.data;
                    }).then(response=>{ 
                    let rows = response.data.map(function(obj){
                        return {...obj,"actions":[{EditButton,props:{id:obj.id}}]}
                    
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
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>

