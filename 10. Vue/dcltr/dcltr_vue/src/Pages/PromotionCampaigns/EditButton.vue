<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit(id)" v-if="pagePermission">Edit</a>
</template>

<script>
import {mapState } from "vuex";

export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'EditPromotionCampaigns', params:{id: this.id}});
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.promotion_campaigns.includes('edit')  ? true : false;
              }
        })
    },
};
</script>