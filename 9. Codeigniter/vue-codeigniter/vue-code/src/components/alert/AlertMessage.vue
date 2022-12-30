<template>
    <br/>
    <div :class="`alert alert-${color}`" role="alert">
        {{message}}
    </div>
</template>
<script>
export default {
    name : 'AlertMessage', 
    props : {
        message : {
            type : String, 
            required : true,
            default : 'Default Message'
        }, 
        color : {
            type : String, 
            required : true,
            default : 'success'
        }
    }
}
</script>