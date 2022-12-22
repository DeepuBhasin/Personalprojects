<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-success btn-xs" @click="edit(id)">Edit</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'EditSection', params:{id: this.id}});
        }
    }
};
</script>