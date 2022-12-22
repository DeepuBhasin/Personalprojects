<template>
    <SectionHeader header="Promotion Campaigns" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/promotioncampaigns">Promotion Campaigns</router-link>
            </li>
         </template>
        <template v-slot:title>
            <h3 class="card-title">Promotion Campaigns</h3>
            <router-link :to="{name:'CreateCampaignsProgram'}" class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add">Create Program</router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" :class="activePromotion ? 'active' : ''"  @click="tabClick(true,false)">Active</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" :class="inActivePromotion ? 'active' : ''"  @click="tabClick(false,true)">No Active</button>
                    </li>
                </ul>
                 <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" :class="activePromotion ? 'active show' : ''"  id="home" role="tabpanel" aria-labelledby="home-tab">
                        <ActivePromotionList />
                    </div>
                    <div class="tab-pane fade" :class="inActivePromotion ? 'active show' : ''" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <InactivePromotionList />
                    </div>
                 </div>    
            </div>
        </template>
</SectionHeader>
</template>
<script>
import ActivePromotionList from '@/Pages/PromotionCampaigns/ActivePromotionList.vue';
import InactivePromotionList from '@/Pages/PromotionCampaigns/InactivePromotionList.vue'
import {mapState} from 'vuex'
export default {
  name : 'PromotionCampaigns',
        components: {
        ActivePromotionList,
        InactivePromotionList
    },
    computed:{
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.promotion_campaigns?.includes('page')  ? true : false,
                      add :  state.permission?.promotion_campaigns?.includes('add')  ? true : false,
                  }
              }
          }),
    },
    methods:{
        checkPermission(){
            return this.pagePermission.page;
        },
        tabClick(activePromotion, inActivePromotion) {
            this.activePromotion = activePromotion;
            this.inActivePromotion = inActivePromotion;
        }
    },
    data() {
        return {
            activePromotion : true,
            inActivePromotion : false
        }
    },
    created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>

