<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="toggleModal({status:true, type:'manageSearchForm', id, form})" v-if="pagePermission">Manage Search</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.category_management.includes('manage_search')  ? true : false;
              }
        })
    },
    props:{
        id: Number,
        form: Object
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        edit(){
            this.$router.push({name:'EditCategoryPage', params:{id: this.id}});
            console.log("Edit clicked", this.id);
        }
    }
};
</script>