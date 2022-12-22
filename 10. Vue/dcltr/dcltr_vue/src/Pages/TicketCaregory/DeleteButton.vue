<template>
    <a class="btn btn-danger btn-xs" @click="deleteFormLocal({id})" v-if="pagePermission">Delete</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"])
    },
    props:{
        id: Number,
    },
    methods:{
        ...mapActions('helpers',["deleteTicketCategory"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to delete this ticket Category ?')){
                this.deleteTicketCategory(data)
            }
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.ticket_category.includes('delete')  ? true : false;
              }
        })
    },
};
</script>