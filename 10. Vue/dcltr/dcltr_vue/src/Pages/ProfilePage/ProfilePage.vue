<template>
It's the Profile
</template>
<script>
export default {
    data(){
        return{
            title:"Aman"
        }
    },
    computed:{
        updatedName(){
            return this.title+"-Boss";
        }
    },

    name : 'profile-page'
}
</script>