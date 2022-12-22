<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit(id)" v-if="pagePermission">Edit</a>
</template>

<script>
import {  mapState } from "vuex";

export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'EditTicketCategory', params:{id: this.id}});
        }
    },
     computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.ticket_category.includes('edit')  ? true : false;
              }
        })
    },
};
</script>