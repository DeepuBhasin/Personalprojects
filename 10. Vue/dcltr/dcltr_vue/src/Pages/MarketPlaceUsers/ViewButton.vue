<template>
    <a class="btn btn-primary btn-xs" @click="viewUser({id})" v-if="pagePermission">View User</a>
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
        ...mapActions('helpers',["deleteUser"]),
        viewUser(data){
            this.$router.push({name:'ViewUser', params:{id: this.id}})
        }
    },
     computed: {
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.user_management.includes('view')  ? true : false;
              }
        })
    },

};
</script>