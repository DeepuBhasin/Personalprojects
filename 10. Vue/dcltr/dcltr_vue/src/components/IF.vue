<template>
<div v-if="cond">
<slot></slot>
</div>

</template>
<script>
export default {
    props: ["cond"],
    name: 'IF'
}
</script>