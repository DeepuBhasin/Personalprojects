<template>
    <SectionHeader header="All Notifications" :titleBoolen="true">
        <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/seeAllNotification">All Notifications</router-link>
            </li>
        </template>    
        <template v-slot:title>
            <h3 class="card-title">All Notifications</h3>
        <router-link :to="{name:'CreateTicket'}"><a class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add" >Create Ticket </a></router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <ul v-for="item in notificationArray" :key="item.id">
                    <li><router-link :to="`/product/${item.data.product_id}/${item.id}`">{{item.data.message}} {{convertDate(item.created_at)}}</router-link></li>
                </ul>
            </div>
        </template>
</SectionHeader>
</template>
<script>
import { mapState } from 'vuex';
import {getDateTime} from '@/Utils/index.js';
import {getRequest} from '@/store/api.js'
export default {
    name : 'CustomerSupport',
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.customer_support?.includes('page')  ? true : false,
                      view :  state.permission?.customer_support?.includes('view')  ? true : false,
                  }
              }
          }),
    },
    methods:{
        convertDate(dt){
            return getDateTime(dt);
        },
        checkPermission(){
            return this.pagePermission.page;
        },
    },
   data(){
        return {
            notificationArray : [],
        }
    },
    async mounted(){
        this.notificationArray = await getRequest('admin/notification');
    },
    created(){
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>

