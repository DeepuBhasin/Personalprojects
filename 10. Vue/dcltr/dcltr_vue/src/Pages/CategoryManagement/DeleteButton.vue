<template>
    <a class="btn btn-danger btn-xs" @click="deleteCategoryLocal({id})" v-if="pagePermission">Delete</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.category_management.includes('delete')  ? true : false;
              }
        })
    },
    props:{
        id: Number,
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["deleteCategory"]),
        deleteCategoryLocal(data){
            if(confirm('Are you sure?')){
                this.deleteCategory(data)
            }
            console.log("Delete clicked", data);
        }
    }
};
</script>