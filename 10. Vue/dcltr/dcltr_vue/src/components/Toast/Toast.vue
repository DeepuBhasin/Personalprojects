<template>
<div :class="{'alert  d_toast_right':true,'alert-danger':type=='error', 'alert-success':type=='success'}" role="alert" v-if="isVisible">
    {{message}}
</div>
<slot></slot>
</template>

<script>
export default {
    name: 'Toast',

    data() {
        return {
            isVisible: false,
            message: '',
            type: String
        }
    },
    methods: {
        showToast: function (message, type='success', timeout = 0) {
            this.isVisible = true;
            this.type = type;
            this.message = message;
            //this.alertColor = alertColor;
            timeout && setTimeout(() => {
                this.hideToast()
            }, timeout);
        },
        hideToast: function () {
            this.isVisible = false;
            this.message = '';
            //this.alertColor = '';
        }
    },
    provide: function () {
        return ({
            hide: this.hideToast,
            show: this.showToast
        })
    }
}
</script>

<style scoped>
.d_toast_left {
    position: fixed;
    top: 10px;
    left: 10px;
    width: 300px;
    z-index: 9999 !important;
}

.d_toast_right {
    z-index: 10;
    position: fixed;

    top: 10px;
    right: 10px;
    width: 300px;
    z-index: 9999 !important;
}
</style>
