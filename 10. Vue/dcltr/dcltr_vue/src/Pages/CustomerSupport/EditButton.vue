<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit(id)" v-if="pagePermission">Edit</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'EditFormBuilder', params:{id: this.id}});
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.forms_management.includes('edit')  ? true : false;
              }
        })
    },
};
</script>