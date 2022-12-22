<template>
    <a class="btn btn-danger btn-xs" @click="deletePlanConfirmation({id})" v-if="pagePermission">Delete</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.plans_management.includes('delete')  ? true : false;
              }
        }),
    },
    props:{
        id: Number,
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["deletePlan"]),
        deletePlanConfirmation(data){
            if(confirm('Are you sure you want to delete this plan ?')){
                this.deletePlan(data)
            }
            console.log("Delete clicked", data);
        }

    }
};
</script>