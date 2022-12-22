<template>
    <a class="btn btn-danger btn-xs" @click="deleteFormLocal({id,status:0})" v-if="status == 1 && pagePermission">Close</a>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
    props:{
        id: Number,
        status : Number
    },
    methods:{
        ...mapActions('helpers',["closeTicket"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to cloes this ticket ?')){
                this.closeTicket(data)
            }
        }
    },
     computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.customer_support?.includes('close')  ? true : false;
              }
        })
    },
};
</script>