<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-primary btn-xs" @click="edit(id)" v-if="pagePermission">View</a>
</template>
<script>
import { mapState } from 'vuex';
export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'ViewStaff', params:{id: this.id}});
        }
    },
     computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.staff_users.includes('view')  ? true : false;
              }
        })
    },
    
    
};
</script>