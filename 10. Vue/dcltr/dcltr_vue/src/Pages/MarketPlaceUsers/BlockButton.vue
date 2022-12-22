<template>
    <a class="btn btn-warning btn-xs" @click="obj.is_block?unblockUser({id}):blockUser({id})" v-if="pagePermission">{{obj.is_block?'UnBlock':'Block'}}</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    computed:{
        ...mapState('modal',["status"])
    },
    props:{
        id: Number,
        obj: Object
    },
    methods:{
        ...mapActions('modal',["toggleModal"]),
        ...mapActions('helpers',["blockUser", "unblockUser"]),
    },
     computed: {
        ...mapState('modal', ["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.user_management.includes('block')  ? true : false;
              }
        })
    },
};
</script>