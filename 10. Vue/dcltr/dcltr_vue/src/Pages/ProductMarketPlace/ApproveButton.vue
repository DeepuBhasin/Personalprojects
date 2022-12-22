<template>
  <a class="btn btn-success btn-xs" @click="approve(id)" v-if="pagePermission">Approve</a>
</template>

<script>
import { mapActions, mapState } from "vuex";
import { api } from "@/store/api";

export default {
  props: {
    id: Number,
  },
  methods: {
    ...mapActions("modal", ["toggleModal"]),
    ...mapActions("helpers", ["deleteForm", "updateProduct"]),
    approve(sid) {
      api
        .get(`admin/product/updateStatus/${sid}`)
        .then((data) => data.data)
        .then((response) => {
          console.log("Response of Add Scubscription", response);
          this.service = response;
          this.updateProduct({status: true, msg:response.message});
          //this.addPlan({Message:response.Message, status: true});
        });
    },
  },
  computed: {
    ...mapState("modal", ["status"]),
    ...mapState("users", {
      pagePermission: (state) => {
        
        return state.permission?.product_market_place.includes('approve')  ? true : false;
      },
    }),
  },
};
</script>
