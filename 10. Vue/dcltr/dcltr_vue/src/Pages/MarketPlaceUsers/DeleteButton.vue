<template>
    <a class="btn btn-danger btn-xs" @click="deleteUserConfirmation({id})" v-if="pagePermission">Delete</a>
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
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["deleteUser"]),
        deleteUserConfirmation(data){
            if(confirm('Are you sure you want to delete this users ?')){
                this.deleteUser(data)
            }
        },
    },
    computed: {
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.user_management.includes('delete')  ? true : false;
              }
        })
    },
};
</script>