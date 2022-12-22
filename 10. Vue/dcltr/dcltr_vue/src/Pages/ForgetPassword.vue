<template>
    <div id="forget-password">
        <h1>Forget Password</h1>
        <div class="forget">
            <input type="text" name="" id="" placeholder="Enter Email"><br/>
            <button >Send Link</button>
        </div>
    </div>
</template>
<script>

export default {
    name : 'ForgetPassword'
}
</script>
<style scoped>
.forget input{
    width: 300px;
    height: 40px;
    padding-left: 20px;
    display: block;
    margin-bottom: 30px;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid skyblue;
}
.forget button{
    width: 320px;
    height: 40px;
    border: 1px solid skyblue;
    color: #fff;
    background-color: skyblue;
    cursor: pointer;
}
</style>
