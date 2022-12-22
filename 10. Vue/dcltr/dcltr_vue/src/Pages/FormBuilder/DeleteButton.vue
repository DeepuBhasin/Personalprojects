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
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["deleteForm"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to delete this form ?')){
                this.deleteForm(data)
            }
            console.log("Delete clicked", data);
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.forms_management.includes('delete')  ? true : false;
              }
        })
    },
};
</script>