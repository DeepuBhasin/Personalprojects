<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-primary btn-xs" @click="edit()" v-if="pagePermission">View</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
         ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.category_management.includes('view')  ? true : false;
              }
        })
    },
    props:{
        id: Number,
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions("helpers", ["updateCatCurrentPage"]),
        edit(){
            console.log("View clicked", this.id);
            this.updateCatCurrentPage("1");
            let _id = this.id;
            this.$router.push({name:'ViewCategoryPage', params:{id: _id}});
            
        }
    }
};
</script>