<template>
<div class="content-wrapper" style="min-height: 242px;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service Request(s)</h1>
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="/marketplaceusers">Service Request(s)</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <Card>
        <template v-slot:title>
            <h3 class="card-title">Service Request(s)</h3>
            <!-- <span class="pull-right">
                <select @change="updateUserType()" v-model="userType">
                    <option value="All">All</option>
                    <option value="Recycler">Recycler</option>
                    <option value="Charitable">Charitable Organization</option>
                    <option value="ScrapDealer">Scrap Dealer</option>
                    <option value="ServiceProvider">Service Provider</option>
                    <option value="Regular">Customer</option>
                </select>
            </span> -->
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
            -->
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                       <span v-if="pagePermission.view || pagePermission.approve ||  pagePermission.reject"></span>
                        <span v-else>{{columns[4]=''}}</span>   
                    <!-- <h1>Category Management</h1> -->
                    <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="service"></ITable>
                </div>
            </div>
        </template>
    </Card>
    <Modal :status="status" @closeModal="toggleModal({status:false})" :title="'Reason to Reject Service'">
        <form @submit.prevent="rejectRequest()">
            <div class="form-control">
                <textarea required v-model="reason" class="form-control" placeholder="Reason">
                
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </Modal>
</div>

</template>

<script>
import Card from '@/components/Card/Card.vue'
import ITable from '../../components/ITable/ITable.vue'
import ViewButton from '@/Pages/Services/ViewButton'
import RejectButton from '@/Pages/Services/RejectButton'
import ApproveButton from '@/Pages/Services/ApproveButton'
import Modal from '@/components/Modal/Modal.vue'
import { mapActions, mapState } from 'vuex'
import {api} from '@/store/api'

import lodash from 'lodash'
export default {
        components: {
        Card,
        ITable,
        Modal
    },
    computed:{

         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.services?.includes('page')  ? true : false,
                      
                      view :  state.permission?.services?.includes('view')  ? true : false,
                      approve :  state.permission?.services?.includes('approve')  ? true : false,
                      reject :  state.permission?.services?.includes('reject')  ? true : false,
                      
                  }
              }
          }),
        ...mapState('modal',["status","id"]),
        ...mapState('helpers',["serviceCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])
    },
    watch: {

        id(to, from){
            console.log("id",to, from)
        },
        status(to, from){
            console.log("visibility",to, from)
        },
        
        userType(to, from){
                console.log(to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(to,1)
        },
        statusToken(to, from){
                console.log("statusToken",to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(this.serviceCurrentPage)
        },
        serviceCurrentPage: function (to, from) {
            if(typeof to != "undefined")
            this.refresh(to)
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(this.serviceCurrentPage);
            }
        }
    },
    methods:{
        ...mapActions("modal",["toggleModal"]),
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
        rejectRequest(e){
            console.log("this is rejection", this.id)
            api.post(`admin/service/updateStatus/${this.id}`, {reason: this.id}).then(data=>data.data).then(response=>{ 
                    
                    this.closeModal({status:false});
                    
                    
                    this.refresh(1);
                })
        }
    },
    mounted:function(){
        this.refresh(this.serviceCurrentPage);
    },
    inject:["show","hide"],
    data(){
        return {
            
            reason:"",
            isChild:  'id' in this.$route.params,
            
            refresh: function(page=1){

                api.get(`admin/service/list?page=${page}`).then(data=>data.data).then(response=>{ 
                    let rows = response.data.map(function(obj){

                        if (obj.status == 1){
                            return {...obj, "actions":[{ViewButton ,props:{id:obj.id ,obj}},  {ApproveButton, props:{id:obj.id}}, {RejectButton, props:{id:obj.id}}]}    
                        }else{
                            return {...obj, "actions":[{ViewButton ,props:{id:obj.id ,obj}}]}
                        }
                        
                    })
                    this.meta = response.meta
                    
                    this.rows = rows;
                    //this.refresh(1);
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped"],
            columns: [
                {'title':'Title', key:'title'},
                {'title':'Date', key:'date'},
                {'title':'Status', key:'statusText', titleCase: true},
                {'title':'User', key:'user.name'},
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

