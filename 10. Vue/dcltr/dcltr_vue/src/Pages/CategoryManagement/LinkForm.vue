<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-info btn-xs" @click="toggleModal({status:true, cat_id, type:'linkForm'})" v-if="pagePermission">Link Form</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.category_management.includes('link_form')  ? true : false;
              }
        })
    },
    props:{
        cat_id: Number,
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