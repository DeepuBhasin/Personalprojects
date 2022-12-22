<template>
    <SectionHeader header="Create Staff User" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
                <li class="breadcrumb-item active">
                    <router-link to="/marketplaceusers">User Management</router-link>
                </li>
        </template>        
        <template v-slot:title>
            <h3 class="card-title">User Management</h3>
            <span class="pull-right">
                <select @change="updateUserType()" v-model="userType">
                    <option value="All">All</option>
                    <option value="Recycler">Recycler</option>
                    <option value="Charitable">Charitable Organization</option>
                    <option value="ScrapDealer">Scrap Dealer</option>
                    <option value="ServiceProvider">Service Provider</option>
                    <option value="Regular">Customer</option>
                </select>
            </span>
            <!-- <router-link :to="{name:'AddFormBuilder'}"><a class="btn btn-primary btn-sm pull-right" >Create Form </a></router-link>
            
            -->
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <div class="form-group">
                    <span v-if="pagePermission.view || pagePermission.delete ||  pagePermission.block || pagePermission.pro_normal" ></span>
                         <span v-else>{{columns[4]=''}}</span>  
                    <!-- <h1>Category Management</h1> -->
                    <ITable :classes="classes" :perPageLimit="true" :columns="columns" :rows="rows" :meta="meta" section="user"></ITable>
                </div>
            </div>
        </template>
    </SectionHeader>
</template>
<script>
import Card from '@/components/Card/Card.vue'
import ITable from '../../components/ITable/ITable.vue'
import AttachButton from '@/Pages/CategoryManagement/AttachButton';
import DeleteButton from './DeleteButton.vue';
import BlockButton from './BlockButton.vue';
import PremiumUserButton from './PremiumUserButton.vue';
import ViewButton from '@/Pages/MarketPlaceUsers/ViewButton'
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
                      page :  state.permission?.user_management?.includes('page')  ? true : false,
                      view :  state.permission?.user_management?.includes('view')  ? true : false,
                      delete :  state.permission?.user_management?.includes('delete')  ? true : false,
                      block :  state.permission?.user_management?.includes('block')  ? true : false,
                      pro_normal :  state.permission?.user_management?.includes('pro_normal')  ? true : false,
                  }
              }
          }),
        ...mapState('modal',["status","id"]),
        ...mapState('helpers',["userCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType", "sortKey", "sortDirection", "perPage", "filterCriteria"])
    },
    watch: {
        userType(to, from){
                console.log(to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(to,1)
        },
        statusToken(to, from){
                console.log("statusToken",to, from);
                //this.isChild = 'id' in this.$route.params
                this.refresh(this.userType, this.userCurrentPage)
        },
        userCurrentPage: function (to, from) {
            if(typeof to != "undefined")
            this.refresh(this.userType, to)
        // this watcher will be called once address changed
        // you can have access to previous and new values.
        },
        perPage(to, from){
            console.log("Now Sortable chnaged", to, from)
            this.refresh(this.userType,1);
        },
        filterCriteria: {
                handler(to, from){
                    console.log("Now filterCriteria", to, from)
                    this.refresh(this.userType,1);
                },deep: true
        },

        actionTaken: function(newState, oldState){
            if(newState.status){
                this.show(newState.msg, "success", 2000)
                this.refresh(this.userType, this.userCurrentPage);
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
        this.refresh(this.cat_id, this.userCurrentPage);
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
            userType: 'All',
            refresh: function(userType, page=1){
                 
                userType = userType?userType:'All';
                console.log("Refresh Called..", userType);
                let _url = `admin/getAllUsersByType/${userType}?&page=${page}`;
                if(this.perPage && this.perPage.hasOwnProperty('rowsPerPage') && this.perPage.rowsPerPage!=''){
                    _url = `${_url}&per_page=${this.perPage.rowsPerPage}`
                }
                api.get(_url).then(data=>data.data).then(response=>{ 
                    console.log("data",response); 
                    
                    let rows = response.data.map(function(obj){
                        
                        let roles = obj.types.reduce((roles, newRole)=>{ return `${roles} / ${newRole.role.title}` },'').replace(/ \/ /, '');
                        
                        return {...obj, "roles":roles, "actions":[{ViewButton ,props:{id:obj.id ,obj}}, {BlockButton, props:{id:obj.id, obj}}, {PremiumUserButton, props:{id:obj.id, obj}}, {DeleteButton, props:{id:obj.id}}]}
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
                {'title':'Name', key:'name'},
                {'title':'EMail', key:'email'},
                {'title':'Roles', key:'roles'},
                {'title':'Phone Number', key:'phone_number'},
                
                
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

