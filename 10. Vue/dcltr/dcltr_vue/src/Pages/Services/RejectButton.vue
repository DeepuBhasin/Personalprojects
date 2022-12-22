<template>
  <a class="btn btn-danger btn-xs" @click="reject(id)" v-if="pagePermission">Reject</a>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
  computed: {
    ...mapState("modal", ["status"]),
  },
  props: {
    id: Number,
  },
  methods: {
    ...mapActions("modal", ["toggleModal"]),
    ...mapActions("helpers", ["deleteForm"]),
    reject(id) {
      this.toggleModal({ status: true, type:'reject', id });
    },
  },
  computed: {
    ...mapState("users", {
      pagePermission: (state) => {
        return state.permission?.services.includes('reject')  ? true : false;
      },
    }),
  },
};
</script>
