<template>
<a class="btn  btn-xs" :class="obj.is_active? 'btn-danger' : 'btn-warning' " @click="statusMethod({id})" v-if="pagePermission">
    {{obj.is_active?'Deactivate' : 'Activate'}}</a>
<!-- <div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" :id="'customSwitchEdit'+id" @click="blockUser({id})" :checked="obj.is_block?true:null">
        <label class="custom-control-label" :for="'customSwitchEdit'+id"></label>
    </div>
</div> -->
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";

export default {
    computed: {
        ...mapState('modal', ["status"]),
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return state.permission?.promotion_campaigns.includes('active')  ? true : false;
              }
        })
    },
    props: {
        id: Number,
        obj: Object
    },
    methods: {
        ...mapActions('modal', ["toggleModal"]),
        ...mapActions('helpers', ["statusCampaign"]),
        statusMethod(data) {
            this.statusCampaign(data)
        }
    }
};
</script>
