<template>
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" :to="{name : 'login'}"> Project </router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link :to="{ name : 'login'}" class="nav-link">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name : 'signup'}" class="nav-link">Sign Up</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>
<script>
export default {
    name : 'NavBarComponent'
}
</script>