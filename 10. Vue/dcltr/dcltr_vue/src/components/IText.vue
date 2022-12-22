<template>

    <input :type="type" :name="name" @input="update" ref="myText" :class="classes" :placeholder="placeholder" />

</template>
<script>
export default {
    props:{
        name:"",
        classes:"",
        placeholder:"",
        modelValue:"",
        type:""
    },
    computed: {
        updatedVal(){
            return this.modelValue;
        }
    },
    emits:["update:modelValue"],
    methods:{
        update(data){
            this.$emit("update:modelValue", this.$refs.myText.value)
        }
    }
}
</script>
<style scoped>
input {
    width: 300px;
    height: 40px;
    padding-left: 20px;
    display: block;
    margin-bottom: 5px;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid skyblue;
}
</style>