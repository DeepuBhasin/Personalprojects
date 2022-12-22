<template>
    <!-- @click="toggleModal({status:true, id})" -->
    <a class="btn btn-primary btn-xs" @click="edit(id)">View</a>
</template>
<script>
export default {

    props:{
        id: Number,
    },
    methods:{
        
        edit(){
            this.$router.push({name:'ViewSectionDetail', params:{id: this.id}});
        }
    }
};
</script>