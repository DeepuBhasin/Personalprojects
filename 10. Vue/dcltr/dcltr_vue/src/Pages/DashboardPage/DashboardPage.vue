<template>
    <SectionHeader header="Dashboard" :titleBoolen="false">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/dashboard">Dashboard</router-link>
            </li>
         </template>    
          <template v-slot:body>   
            <div class="row">
                Welcome To D'Cluter
            </div>
          </template>
    </SectionHeader>    
 </template>
<script >
import Builder from "@/components/Builder.vue";
export default {
    name: "dashboard",
    components: {
        Builder
    }
}
</script>