<template>
    <SectionHeader header="Staff Users" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
            <router-link to="/staffusers">Staff Users</router-link>
            </li>
        </template>
        <template v-slot:title>
            <h3 class="card-title">Staff Users</h3>
            <router-link :to="{name:'AddAdmin'}"><a class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add" >Create Staff</a></router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <span v-if="pagePermission.view || pagePermission.edit ||  pagePermission.delete || pagePermission.block || pagePermission.password" ></span>
                <span v-else>{{columns[5]=''}}</span>    
                
                <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
            </div>
        </template>
    </SectionHeader>
    <Modal :status="status" @closeModal="closeModal({status:false})" :title="'Change Password'">
        <ChangePasswordModal :id="id" />
    </Modal>
    
</template>
<script>
import ITable from '../../components/ITable/ITable.vue'
import DeleteButton from '@/Pages/StaffUsers/DeleteButton.vue';
import ViewButton from '@/Pages/StaffUsers/ViewButton.vue';
import EditButton from '@/Pages/StaffUsers/EditButton.vue';
import BlockButton from '@/Pages/StaffUsers/BlockButton.vue';
import PasswordButton from '@/Pages/StaffUsers/PasswordButton.vue';
import ChangePasswordModal from '@/Pages/StaffUsers/ChangePasswordModal.vue'
import Modal from '@/components/Modal/Modal.vue';
import { mapActions, mapState } from 'vuex';
import {api} from '@/store/api';
export default {
        components: {
        ITable,
        ViewButton,
        DeleteButton,
        EditButton,
        BlockButton,
        PasswordButton,
        Modal,
        ChangePasswordModal
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.staff_users?.includes('page')  ? true : false,
                      add :  state.permission?.staff_users?.includes('add')  ? true : false,
                      
                      view :  state.permission?.staff_users?.includes('view')  ? true : false,
                      edit :  state.permission?.staff_users?.includes('edit')  ? true : false,
                      delete :  state.permission?.staff_users?.includes('delete')  ? true : false,
                      block :  state.permission?.staff_users?.includes('block')  ? true : false,
                      password :  state.permission?.staff_users?.includes('password')  ? true : false,
                  }
              }
          }),
        ...mapState('modal',["status" ,"id", "type"]),
        ...mapState('helpers', ["planCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])
    },
    watch: {
        status(to, from){
        },
        type(to, from){
        },

        statusToken(to, from){
             this.refresh(this.userType, this.planCurrentPage)
        },
        planCurrentPage: function (to, from) {
            if(typeof to != "undefined")
            this.refresh(this.userType, to)
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, newState.type, 2000)
                if(newState.type=='success'){
                    this.closeModal({status:false})
                }
                this.refresh(this.userType, this.planCurrentPage);
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
        },
        
    },
    mounted:function(){
        this.refresh(this.cat_id, this.planCurrentPage);
    },
    inject:["show","hide"],
    data(){
        return {
            isChild:  'id' in this.$route.params,
            currentPlan: {},
            refresh: function(pageIndex){
                api.get(`admin/adminList?page=${this.planCurrentPage}`).then(data=>{
                        return data.data;
                    }).then(response=>{ 
                    response.data = response.data.filter(obj=>obj.id!==1);
                    let rows = response.data.map(function(obj){
                         obj.created_at = new Date(obj.created_at).toLocaleDateString();
                         obj.last_login = obj.last_login ? obj.last_login : 'N/A';
                         
                        return {...obj,role_name : obj.role.name, "actions":[{ViewButton,props:{id:obj.id}},{EditButton, props:{id:obj.id}},{DeleteButton, props:{id:obj.id}},{PasswordButton, props:{id:obj.id}},{BlockButton, props:{id:obj.id, obj}}]}
                    
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
                {'title':'Phone Number', key:'phone_number'},
                {'title':'Created Date', key:`created_at`},
                {'title':'Profile', key:`role_name`},
                {'title':'Last Activity', key:`last_login`},
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

