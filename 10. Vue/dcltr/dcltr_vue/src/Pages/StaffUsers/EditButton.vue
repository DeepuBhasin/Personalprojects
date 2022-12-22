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
            this.$router.push({name:'EditAdmin', params:{id: this.id}});
        }
    },
     computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.staff_users.includes('edit')  ? true : false;
              }
        })
    },
};
</script>