<template>
    <SectionHeader header="General Settings" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
              <li class="breadcrumb-item active">
                <router-link to="/generalsetting">
                  General Settings
                </router-link>
              </li>
         </template>    
         <template v-slot:title>
            <h3 class="card-title">General Settings</h3>
        </template>
         <template v-slot:body>   
                <form @submit.prevent="onSubmit" autocomplete="off" class="col-md-12">
                  <div class="col-md-6">
                  <div class="form-group"
                    v-for="fields in inputFields"
                    :key="fields.id"
                  >
                    <label
                      style="text-transform: capitalize"
                      :for="fields.title"
                      >{{ fields.title.replace(/_/g, " ") }}</label
                    >
                    <span v-if="fields.type == 'textarea'">
                      <textarea
                        :type="fields.type"
                        :class="'form-control ' + fields.title.toString('_')"
                        :id="fields.title"
                        :placeholder="'Please Enter ' + fields.title.replace(/_/g,' ')"
                        v-model="fields.value"
                      >
                      </textarea>
                    </span>
                    <span v-else-if="fields.type == 'checkbox'">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" :class="'custom-control-input ' + fields.title.toString('_')" id="customSwitch1"  v-model="fields.value">
                        <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </span>
                    <span v-else-if="fields.type == 'file'">
                      <input
                        :type="fields.type"
                        :class="'form-control ' + fields.title.toString('_')"
                        :id="fields.title"
                        accept="image/png, image/gif, image/jpeg"
                        @change="getImage($event, fields.title)"
                      />
                      <p v-if="fields.type == 'file'">
                        <br/>
                        <img style="width:15%; height:15%" class="img-thumbnail" :src="'http://dcltr.oidea.xyz/storage/app/public/'+fields.value" />
                      </p>
                    </span>
                    <span v-else>
                      <input
                        :type="fields.type"
                        :class="'form-control ' + fields.title.toString('_')"
                        :id="fields.title"
                        :placeholder="'Please Enter ' + fields.title.replace(/_/g,' ')"
                        v-model="fields.value"
                        
                      />
                    </span>
                  </div>
                  <button class="btn btn-success" type="submit">Submit</button>
                  </div>
                </form>
         </template>
    </SectionHeader>   
</template>

<script>
import {mapState} from 'vuex'
import { api } from "@/store/api.js";
export default {
  name: "GeneralSetting",
  data() {
    return {
      inputFields: [],
      image: null,
      imageName: null,
      imagesUrl: null,
    };
  },
   computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      page :  state.permission?.general_settings?.includes('page')  ? true : false
                      
                  }
              }
          }),
        
    },
  async mounted() {
    await this.getData();
  },
   created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
  inject: ['show', 'hide'],
  methods: {
      checkPermission(){
            return this.pagePermission.page;
        },
    getImage(e, key) {
      this.image = e.target.files[0];
      this.imageName = key;
    },
    
    async getData() {
      await api
        .get("/admin/generalSetting/getFieldTypes")
        .then((response) => {
          if (response.status == 200) {
            let result = response.data.data;
            let inputArry = [];
            for (let key in result) {
              inputArry[result[key]] = key;
            }

            api.get("/admin/generalSetting").then((response) => {
              if (response.status == 200) {
                let newArrayData = response.data.data;
                for (let id in newArrayData) {
                  newArrayData[id]["type"] =
                    inputArry[newArrayData[id].field_type];
                }
                this.inputFields = newArrayData;
              }
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async onSubmit(e) {
      let fd = new FormData();
      let formDataObject = {};
      const allData = this.inputFields;

      for (let key in allData) {
        formDataObject[allData[key].title] = allData[key].value;
      }

      delete formDataObject.site_logo;        // to delete site logo (hard coded)

      for (let key in formDataObject) {
        fd.append(key, formDataObject[key]);
      }
      
      if(this.image !=null){
        fd.append(this.imageName, this.image, this.image.name);
      }

      await api
        .post("/admin/generalSetting/bulkUpdate", fd, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          if (response.status == 200) {
            this.getData();
            this.show('Setting Update Successfully','success', 3000);
          }
        })
        .catch((error) => {
          this.getData();
          this.show('Setting do not Update','error', 3000);
        });
      },
  },
};
</script>
