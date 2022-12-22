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
        ...mapActions('helpers',["deleteAdminUsers"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to delete this staff ?')){
                this.deleteAdminUsers(data)
            }
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.staff_users.includes('delete')  ? true : false;
              }
        })
    },
};
</script>