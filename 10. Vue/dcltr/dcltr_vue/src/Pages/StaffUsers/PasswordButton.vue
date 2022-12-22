<template>
    <a class="btn btn-info btn-xs" @click="toggleModal({status: true, id})" v-if="pagePermission">Change Password</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.staff_users.includes('password')  ? true : false;
              }
        })
    },
    props:{
        id: Number,
        obj: Object
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["editPlan"]),
    }
};
</script>