<template>
    <a class="btn btn-info btn-xs" @click="toggleModal({status: true, type: 'editPlan', id})" v-if="pagePermission">Edit Plan</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.plans_management.includes('edit')  ? true : false;
              }
        }),
        ...mapState('modal',["status"])
    },
    props:{
        id: Number,
        obj: Object
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["editPlan"]),
    },
     
};
</script>