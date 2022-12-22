<template>
<Toast>
    <App>
        <router-view></router-view>
    </App>
</Toast>
</template>

<script>
import Toast from '../src/components/Toast/Toast.vue'
import App from './App.vue'
import Modal from '@/components/Modal/Modal.vue'
export default {
    name: 'AppWrapper',
    components: {
        App,
        Toast,
        Modal
    }
}
</script>

<style scoped>

</style>
