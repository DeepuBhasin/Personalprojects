<template>
    <SectionHeader header="Customer Support" :titleBoolen="true">
        <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/customersupport">Customer Support</router-link>
            </li>
        </template>    
        <template v-slot:title>
            <h3 class="card-title">All Tickets</h3>
        <router-link :to="{name:'CreateTicket'}"><a class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add" >Create Ticket </a></router-link>
        </template>
        <template v-slot:body>
            <div class="customerSupportTable">
                <span v-if="pagePermission.view ||  pagePermission.close || pagePermission.reopen"></span>
                <span v-else>{{columns[8]=''}}</span>
                <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
            </div>
        </template>
</SectionHeader>
</template>
<script>
import ITable from '../../components/ITable/ITable.vue'
import ViewButton from '@/Pages/CustomerSupport/ViewButton.vue';
import ClosedButton from '@/Pages/CustomerSupport/ClosedButton.vue';
import ReopenButton from '@/Pages/CustomerSupport/ReopenButton.vue';
import { mapActions, mapState } from 'vuex';
import {api} from '@/store/api';
export default {
    name : 'CustomerSupport',
        components: {
        ITable,
        ViewButton,
        ClosedButton
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.customer_support?.includes('page')  ? true : false,
                      add :  state.permission?.customer_support?.includes('add')  ? true : false,
                      
                      view :  state.permission?.customer_support?.includes('view')  ? true : false,
                      close :  state.permission?.customer_support?.includes('close')  ? true : false,
                      reopen :  state.permission?.customer_support?.includes('reopen')  ? true : false,
                  }
              }
          }),
        ...mapState('modal',["status" ,"id", "type"]),
        ...mapState('helpers',["planCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])
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
    inject: ['show', 'hide'],
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
    data(){
        return {
            isChild:  'id' in this.$route.params,
            currentPlan: {},
            refresh: function(pageIndex){
                api.get(`admin/ticket?page=${this.planCurrentPage}`).then(data=>{
                        return data.data;
                    }).then(response=>{ 
                    let rows = response.data.map(function(obj){
                        obj.ticket_id = '#'+obj.id
                         obj.created_at = new Date(obj.created_at).toLocaleDateString().toString();
                         obj.updated_at = new Date(obj.updated_at).toLocaleDateString();
                         obj.ticket_category = obj.category.name;
                         obj.user_name = obj.user.name;
                        obj.priority = obj.priority == 0 ? 'Low' : obj.priority == 1 ? 'Medium' : 'High';
                        obj.statusText = obj.status == 0 ? 'Closed' : obj.status == 1 ? 'Open' : 'Re-Open';  

                        return {...obj,"actions":[{ViewButton,props:{id:obj.id}},{ClosedButton,props:{id:obj.id,status:obj.status}},{ReopenButton,props:{id:obj.id,status:obj.status}}]}
                    })
                    this.meta = response.meta
                    this.rows = rows;
                })
            },
            categoryTypes:[],
            classes:["table", "table-stripped","table-striped",'capital'],
            columns: [
                {'title':'Ticket Id', key:'ticket_id'},
                {'title':'Ticket title', key:'title'},
                {'title':'Ticket Category', key:'ticket_category'},
                {'title':'Created By', key:'user_name'},
                {'title':'Priority', key:'priority'},
                {'title':'Status', key:'statusText'},
                {'title':'Created At', key:'created_at'},
                {'title':'Updated At', key:`updated_at`},
                {'title':'Actions', key:'actions'},
            ],
            rows:[
                    {
                        // 'id':'1',
                        // 'ticket_title':'Electronics',
                        // 'name':'Deepinder',
                        // 'phone_number':'9911552255',
                        // 'created_by' : 'Admin (admin)',
                        // 'created_at' : '21/2/2022',
                        // 'actions':[{ViewButton,props:{id:1}}]
                    }
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

