<template>
    
    <section :class="{'show':status, 'imodal-container':true}">
      <div class="imodal">
        <div class="modal-header">
          <h5 class="modal-title">{{title}}</h5>
            <button type="button" class="close btn imodal-btn"  @click="toggleModal()">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
        
            <slot></slot>
          </div>        
      </div>
    </section>
</template>
<script>
export default {
    name: "Modal",
    title: "Title",
    props:["status", "title"],
    methods:{
        toggleModal: function(){
            // console.log("Close Modal Called.");
            this.$emit("closeModal")
        }
    }
}
</script>
<style scoped>
.imodal-container {
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.35);
  height: 100vh;
  width: 100vw;
  display: flex !important;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 0;
  pointer-events: none;
  transition: all 0.2s ease-in-out;
}

.imodal {
  background-color: white;
  border-radius: 6px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
  padding: 0px;
  width: 500px;
  margin: auto;
}

.imodal h1,
.imodal p {
  margin-bottom: 17px;
}

/* Dynamic Class(es) */
.show {
  opacity: 1;
  pointer-events: auto;
}
</style>