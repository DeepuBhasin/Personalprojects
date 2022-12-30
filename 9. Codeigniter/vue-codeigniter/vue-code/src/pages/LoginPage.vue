<template>
  <NavBarComponent />
  <div class="container-fluid">
    <div class="row justify-content-center my-4">
      <div class="col-md-6">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
import NavBarComponent from "@/components/navbar/NavBarComponent.vue";
export default {
  name: "LoginPage",
  components: {
    NavBarComponent
  }
};
</script>
