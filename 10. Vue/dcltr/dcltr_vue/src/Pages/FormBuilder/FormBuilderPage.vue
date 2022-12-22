<template>
<SectionHeader header="Form Management" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/formbuilder">Form Management</router-link>
        </li>

        <li class="breadcrumb-item active">
            <template v-if="editId ==0">
                Create Form
            </template>
            <template v-else>
                Edit Form
            </template>
        </li>
    </template>
    <template v-slot:title>    
        <h3 class="card-title">Form Elements</h3>
     </template>
    <template v-slot:body>
            <div class="row">
                <div class="col-md-12">
                    <Builder :editId="editId"></Builder>
                </div>
            </div>
    </template>
</SectionHeader>
</template>
<script >
import Builder from "@/components/Builder.vue";
import {mapState} from 'vuex';
export default {
    name: "formbuilder",
    data(){
        return {
            editId:  'id' in this.$route.params ? this.$route.params.id : 0
        }
        
    },
    
    components: {
        Builder
    },
    computed:{
        ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      edit :  state.permission?.forms_management?.includes('edit')  ? true : false,
                      
                  }
              }
          }),
    },
    methods:{
        checkPermission(){
            return this.pagePermission.edit;
        },
    },
      created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
}
</script>