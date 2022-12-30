<template>
    <UserNavBarComponent/>
    <div class="container-fluid">
    <div class="row justify-content-center my-4">
      <div class="col-md-6">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
import UserNavBarComponent from "@/components/navbar/UserNavBarComponent.vue";
export default {
    name : 'AppLayout',
    components : {
        UserNavBarComponent
    }
}
</script>