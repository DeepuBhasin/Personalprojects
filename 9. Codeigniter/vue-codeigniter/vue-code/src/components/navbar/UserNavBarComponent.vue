<template>
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" :to="{name : 'dashboard'}"> Welcome </router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link :to="{ name : 'myprofile'}" class="nav-link">My Profile</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name : 'searchuser'}" class="nav-link">Search User</router-link>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" @click.prevent="logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>
<script>
import { clearToken } from '@/api/api-functions';
export default {
    name : 'UserNavBarComponent',
    methods:{
      logout() {
        alert('You are logout successfully');
        clearToken();
        this.$router.replace('/');
      }
    }
}
</script>