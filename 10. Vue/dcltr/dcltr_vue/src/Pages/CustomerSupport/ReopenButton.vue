<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit(id)"  v-if="status == 0 && pagePermission">Reopen</a>
</template>
<script>
import {mapState } from "vuex"; 
export default {
    props:{
        id: Number,
        status : Number
    },
    methods:{
        edit(){
            this.$router.push({name:'ReOpen', params:{id: this.id}});
        }
    },
     computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.customer_support?.includes('reopen')  ? true : false;
              }
        })
    },
};
</script>