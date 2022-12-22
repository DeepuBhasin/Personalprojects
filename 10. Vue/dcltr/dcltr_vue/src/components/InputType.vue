<template>
    <div class="form-group">
        <label :for="inputObject.id">{{inputObject.label}}</label>
        <input :type="inputObject.type" class="form-control oldPassword" :id="inputObject.id" :name="inputObject.id" :placeholder="inputObject.placeholder" :required="inputObject.required ? true : false">
    </div>
<!-- 
     <InputType :inputObject="{
                                label : 'Old Password',
                                type : 'text',
                                id : 'oldPassword',
                                placeholder : 'Enter Old Password',
                                required : true
                            }"/>
                           <InputType :inputObject="{
                                label : 'New Password',
                                type : 'text',
                                id : 'newPassword',
                                placeholder : 'Enter New Password',
                                required : true
                            }"/>
                            <InputType :inputObject="{
                                label : 'Confirm Password',
                                type : 'text',
                                id : 'confirmPassword',
                                placeholder : 'Enter Confirm Password',
                                required : true
                            }"/> -->
</template>
<script>
export default {
    name:'InputType',
    props:{
        inputObject : Object
    }
}
</script>

<style scoped>

</style>