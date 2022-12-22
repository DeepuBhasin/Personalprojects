<template>
<SectionHeader header="User Management" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
              <li class="breadcrumb-item active">
                <router-link to="/marketplaceusers">User Management</router-link>
            </li>
            <li class="breadcrumb-item active">View User</li>
         </template>
        <template v-slot:title>
            <h3 class="card-title">User Management</h3>
        </template>
        <template v-slot:body>   
            <CardTabs>
                <template v-slot:customTab>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Activity</a>
                </li>
                </template>
                <template v-slot:activeTabContent>
                User
                    <UserInformationPage :user="user"/>
                </template>
            </CardTabs>
        </template>      
    </SectionHeader>
</template>



<script>
import CardTabs from "@/components/Card/CardTabs.vue";
import { api } from "@/store/api";
import UserInformationPage from "./UserInformationPage.vue";
export default {
        components:{
            CardTabs,
            UserInformationPage
        },
        data(){
            return {
                user: {}
            }
        },
        mounted(){
            let uid = this.$route.params.id;
            api.get(`admin/getUserData/${uid}`).then(data=>data.data).then(response=>{ 
                    console.log("Response of Add Scubscription", response)  
                    this.user = response
                    //this.addPlan({Message:response.Message, status: true}); 
                })
        }
}
</script>