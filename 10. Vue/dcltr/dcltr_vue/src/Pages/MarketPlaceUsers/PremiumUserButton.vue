<template>
    <a class="btn btn-success btn-xs" @click="obj?.is_pro?markNormal({id}):markPro({id})" v-if="pagePermission">{{obj?.is_pro?'Unset Premium':'Set Premium'}}</a>
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
        ...mapActions('helpers',["markNormal", "markPro"]),
    },
     computed: {
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.user_management.includes('pro_normal')  ? true : false;
              }
        })
    },
};
</script>