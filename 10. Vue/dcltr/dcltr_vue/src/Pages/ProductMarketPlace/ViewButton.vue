<template>
<router-link :to="{path:'/product/'+this.id}">
    <a class="btn btn-info btn-xs"  v-if="pagePermission">View</a>
</router-link>
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
                  
                  return state.permission?.product_market_place.includes('view')  ? true : false;
              }
        })
    },
};
</script>