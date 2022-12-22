<template>
<!-- <div class="sidebar-mini layout-fixed sidebar-collapse" > -->
<div class="sidebar-mini layout-fixed" >
    <vheader></vheader>
    <sidebar></sidebar>
    <router-view></router-view>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

</div>
</template>

<style>
@import "../../assets/css/main.css";
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");
</style>

<script>
import Vheader from '@/components/Vheader';
import Sidebar from '@/components/Sidebar/Sidebar';

import {
    mapGetters
} from 'vuex';

export default {
    components: {
        Vheader,
        Sidebar,
        ...mapGetters
    },
    beforeMount(){
        let token = localStorage.getItem('token');
        if(!token){
            this.$router.push({name:'Login'}); 
        }
    }
}
</script>
