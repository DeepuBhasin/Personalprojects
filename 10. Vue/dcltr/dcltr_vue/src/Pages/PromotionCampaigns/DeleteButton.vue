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
        ...mapActions('helpers',["deleteCampaign"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to delete this Campaign ?')){
                this.deleteCampaign(data)
            }
        }
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.promotion_campaigns.includes('delete')  ? true : false;
              }
        })
    },
};
</script>