<template>
    <a class="btn btn-danger btn-xs" @click="deleteFormLocal({id})">Delete</a>
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
        ...mapActions('helpers',["delectSection"]),
        deleteFormLocal(data){
            if(confirm('Are you sure you want to delete this section ?')){
                this.delectSection(data)
            }
            console.log("Delete clicked", data);
        }
    }
};
</script>