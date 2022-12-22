<template>
    <SectionHeader header="Edt Promotion Campaigns" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/promotioncampaigns">Promotion Campaigns</router-link>
            </li>
            <li class="breadcrumb-item active">Edt Promotion Campaigns</li>
         </template>
         <template v-slot:title>
            <h3 class="card-title">Edt Promotion Campaigns</h3>
        </template>   
          <template v-slot:body>   
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off" class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title of Promotional Campaign</label>
                            <input type="text" class="form-control title" id="title" name="title" placeholder="Enter Title of Promotional Campaign" v-model.trim="title" />
                            <p v-if="v$.title.$dirty && v$.title.required.$invalid" class="text-danger error-message">
                                {{ v$.title.required.$message }}
                            </p>
                            <p v-else-if="v$.title.$error && v$.title.minLength" class="text-danger error-message">
                                {{ v$.title.minLength.$message }}
                            </p> 
                        </div> 
                        <div class="form-group">
                            <label for="select_type">Type</label>
                            <select class="form-control select_type" id="select_type" name="select_type" v-model.trim="select_type">
                                <option value="">Select Type</option>
                                <option value="0">Recycle</option>
                                <option value="1">Donation</option>
                            </select>
                            <p v-if="v$.select_type.$dirty && v$.select_type.required.$invalid" class="text-danger error-message">
                                {{ v$.select_type.required.$message }}
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control description" id="description" name="description" placeholder="Enter Description" v-model.trim="description" rows="8" />
                            <p v-if="v$.description.$dirty && v$.description.required.$invalid" class="text-danger error-message">
                                {{ v$.description.required.$message }}
                            </p>
                            <p v-else-if="v$.description.$error && v$.description.minLength" class="text-danger error-message">
                                {{ v$.description.minLength.$message }}
                            </p> 
                        </div>
                        <div class="form-group">
                            <label for="max_limit">Max Limit</label>
                            <input type="text" class="form-control max_limit" id="max_limit" name="max_limit" placeholder="Enter Max Limit" v-model.number="max_limit" />
                            <p v-if="v$.max_limit.$dirty && v$.max_limit.required.$invalid" class="text-danger error-message">
                                {{ v$.max_limit.required.$message }}
                            </p>
                            <p v-else-if="v$.max_limit.$error && v$.max_limit.minLength" class="text-danger error-message">
                                {{ v$.max_limit.minLength.$message }}
                            </p> 
                            <p v-else-if="v$.max_limit.$error && v$.max_limit.numeric" class="text-danger error-message">
                                {{ v$.max_limit.numeric.$message }}
                            </p>
                        </div> 
                         <div class="form-group">
                            <label for="name_of_organization_company">Name of organization/company</label>
                            <input type="text" class="form-control name_of_organization_company" id="name_of_organization_company" name="name_of_organization_company" placeholder="Enter Name of organization/company" v-model.trim="name_of_organization_company" />
                            <p v-if="v$.name_of_organization_company.$dirty && v$.name_of_organization_company.required.$invalid" class="text-danger error-message">
                                {{ v$.name_of_organization_company.required.$message }}
                            </p>
                            <p v-else-if="v$.name_of_organization_company.$error && v$.name_of_organization_company.minLength" class="text-danger error-message">
                                {{ v$.name_of_organization_company.minLength.$message }}
                            </p> 
                        </div>
                        <div class="form-group">
                            <label for="address_of_organization_company">Address of organization/company</label>
                            <textarea class="form-control address_of_organization_company" id="address_of_organization_company" name="address_of_organization_company" placeholder="Enter Address of organization/company" v-model.trim="address_of_organization_company" rows="8" />
                            <p v-if="v$.address_of_organization_company.$dirty && v$.address_of_organization_company.required.$invalid" class="text-danger error-message">
                                {{ v$.address_of_organization_company.required.$message }}
                            </p>
                            <p v-else-if="v$.address_of_organization_company.$error && v$.address_of_organization_company.minLength" class="text-danger error-message">
                                {{ v$.address_of_organization_company.minLength.$message }}
                            </p> 
                        </div> 
                        <div class="form-group">
                            <label for="email_of_organization">Email of organization</label>
                            <input type="text" class="form-control email_of_organization" id="email_of_organization" name="email_of_organization" placeholder="Enter Email of organization" v-model.trim="email_of_organization" />
                            <p v-if="v$.email_of_organization.$dirty && v$.email_of_organization.required.$invalid" class="text-danger error-message">
                                {{ v$.email_of_organization.required.$message }}
                            </p>
                            <p v-if="v$.email_of_organization.$dirty && v$.email_of_organization.email.$invalid" class="text-danger error-message">
                                {{ v$.email_of_organization.email.$message }}
                            </p>
                        </div> 
                        <div class="form-group">
                            <label for="promotional_image">Promotional Image</label>
                            <input type="file" name="promotional_image" id="promotional_image" class="form-control promotional_image" accept="image/png, image/gif, image/jpeg" @change="getImage"/>
                            <br/>
                            <img style="width:20%; height:20%" class="img-thumbnail" :src="'http://dcltr.oidea.xyz/storage/'+image" />
                        </div> 
                        <div class="form-group">
                            <label for="set_image_as_background">Set Image as Background</label>
                            <select class="form-control set_image_as_background" id="set_image_as_background" name="set_image_as_background" v-model.trim="set_image_as_background">
                                <option value="">Select Background</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <p v-if="v$.set_image_as_background.$dirty && v$.set_image_as_background.required.$invalid" class="text-danger error-message">
                                {{ v$.set_image_as_background.required.$message }}
                            </p>
                        </div> 
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control from_date" v-model.trim="from_date" />
                            <p v-if="v$.from_date.$dirty && v$.from_date.required.$invalid" class="text-danger error-message">
                                {{ v$.from_date.required.$message }}
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="to_date">To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control to_date" v-model.trim="to_date" />
                            <p v-if="v$.to_date.$dirty && v$.to_date.required.$invalid" class="text-danger error-message">
                                {{ v$.to_date.required.$message }}
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="select_country"> Country </label>
                            <select class="form-control select_country" id="select_country" name="select_country" v-model.trim="select_country" @change="selectCountry">
                                <option value="">Select Country</option>
                                <option v-for="item in selected_country_array" :key="item.id" :value="item.id">{{item.name}}</option>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="select_state">State</label>
                            <select class="form-control select_state" id="select_state" name="select_state" v-model.trim="select_state" @change="selectState"> 
                                <option value="">Select State</option>
                                <option v-for="item in stateArray" :key="item.id" :value="item.id" :data-statename="item.name">{{item.name}}</option>
                            </select>
                        </div>
                        <template v-if="showStatesNameArray.length > 0"> 
                        <div class="form-group">
                            <label>Open in States</label>
                            <table>
                                <ol>
                                <tr v-for="item,index in showStatesNameArray" :key="index">
                                    <td><li>{{item}}</li></td>
                                    <td><button class="btn btn-xs btn-danger mx-5" @click="clearStates(item,showStatesIdArray[index])">X</button></td>
                                </tr>
                                </ol>
                            </table>
                        </div> 
                        </template>
                        <div class="form-group">
                            <label for="select_city">City</label>
                            <select class="form-control select_city" id="select_city" name="select_city" v-model.trim="select_city" @change="selectCity($event)">
                                <option value="">Select City</option>
                                 <optgroup v-for="item,index in cityObject" :key="index" :label="index">
                                    <option v-for="cityItem in item" :key="cityItem.id" :value="cityItem.id" :data-cityname="cityItem.name" :data-statename="index">{{cityItem.name}}</option>
                                 </optgroup>   
                            </select>
                        </div>
                        <template v-if=" Object.keys(showCityNameObject).length > 0"> 
                        <div class="form-group">
                            <label for="select_city">Open in Cities</label>
                            <table>
                            <ul>
                                <li v-for="item,index in showCityNameObject" :key="index">
                                    <tr>
                                        <th colspan="2">{{index}}</th>
                                    </tr>
                                    <ol>
                                        <tr v-for="cityIndex, cityName in item" :key="cityIndex">
                                            <td><li>{{cityName}}</li></td>
                                            <td><button class="btn btn-xs btn-danger mx-5" @click="clearCities(cityIndex, index, cityName)">X</button></td>
                                        </tr>
                                    </ol>
                                </li>
                            </ul>
                            </table>
                        </div> 
                        </template>
                        <div class="form-group">
                            <label for="select_need_inspection">Need Inspection</label>
                            <select class="form-control select_need_inspection" id="select_need_inspection" name="select_need_inspection" v-model.trim="select_need_inspection">
                                <option value="">Select Need Inspection</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <p v-if="v$.select_need_inspection.$dirty && v$.select_need_inspection.required.$invalid" class="text-danger error-message">
                                {{ v$.select_need_inspection.required.$message }}
                            </p>
                        </div> 
                        <div class="form-group">
                            <label for="select_status">Status</label>
                            <select class="form-control select_status" id="select_status" name="select_status" v-model.trim="select_status">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <p v-if="v$.select_status.$dirty && v$.select_status.required.$invalid" class="text-danger error-message">
                                {{ v$.select_status.required.$message }}
                            </p>
                        </div> 
                        
                        <div class="form-group">
                            <button type="submit" name="change" id="change" class="btn btn-success">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
          </template>
    </SectionHeader>          
</template>
<script>
import {mapState} from 'vuex'
import {putRequestForImage,getRequest} from "@/store/api.js";
import {getTimeStampFromDate} from "@/Utils/index.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,numeric,email} from "@vuelidate/validators";
import lodash from "lodash";
import InputType from '@/components/InputType.vue';
export default {
  components: { InputType },
    name: "CreateTicket",
    data() {
        return {
            paramId : 0,
            title: '',
            cities : [],
            select_type: '',
            description : '',
            max_limit : '',
            name_of_organization_company : '',
            address_of_organization_company : '',
            email_of_organization : '',
            set_image_as_background : '',
            from_date : '',
            to_date : '',
            select_country:'',
            selected_country_array : [],
            stateArray : [],
            select_state:'',
            cityObject : {},
            select_city:'',
            showCityNameObject : {},
            showCityIdArray : [],
            showStatesNameArray : [],
            showStatesIdArray : [],
            select_need_inspection : '',
            select_status : '',
            promotional_image : null,
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      add :  state.permission?.promotion_campaigns?.includes('add')  ? true : false
                  }
              }
          }),
    },
    validations() {
        return {
            title: {
                required: helpers.withMessage("Title of Promotional Campaign field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            select_type: {
                required: helpers.withMessage("Type field cannot be empty", required),
            },
            description: {
                required: helpers.withMessage("Description field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            max_limit: {
                required: helpers.withMessage("Max Limit field cannot be empty", required),
                numeric : helpers.withMessage("Please enter only numbers", numeric)
            },
            name_of_organization_company: {
                required: helpers.withMessage("Name of organization/company field cannot be empty", required),
                 minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            address_of_organization_company: {
                required: helpers.withMessage("Address of organization/company field cannot be empty", required),
                 minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            email_of_organization: {
                required: helpers.withMessage("Ticket Category field cannot be empty", required),
                email: helpers.withMessage("Email is not valid", email),
            },
            set_image_as_background: {
                required: helpers.withMessage("Set Image as field field cannot be empty", required),
            },
            from_date: {
                required: helpers.withMessage("From Date field cannot be empty", required),
            },
            to_date: {
                required: helpers.withMessage("To date field cannot be empty", required),
            },
            select_need_inspection: {
                required: helpers.withMessage("Need Inspection field cannot be empty", required),
            },
            select_status: {
                required: helpers.withMessage("Status field cannot be empty", required),
            },
        };
    },
    inject: ['show', 'hide'],
    async  mounted() {
        this.selected_country_array =   await getRequest("getCountries");
        this.paramId = this.$route.params.id;
        let responseData = await getRequest(`admin/campaign/${this.paramId}`);
        this.title = responseData.title;
        this.select_type = responseData.type;
        this.description = responseData.description;
        this.max_limit = responseData.donation_limit;
        this.name_of_organization_company = responseData.company_name;
        this.address_of_organization_company = responseData.company_address;
        this.email_of_organization = responseData.email;
        this.cities = responseData.cities;
        this.image = responseData.image;
        this.set_image_as_background = responseData.set_background_image;
        this.from_date = responseData.start_date;
        this.to_date = responseData.end_date;
        this.select_need_inspection = responseData.need_inspection;
        this.select_status = responseData.is_active;

        responseData.cities.map(city=>{
            this.showCityIdArray.push(city.city_name.id);
            if(this.showCityNameObject[city.city_name.state.name] === undefined){
                this.showCityNameObject[city.city_name.state.name] = {};
                this.showCityNameObject[city.city_name.state.name][city.city_name.name] = city.city_name.id
            } else
                this.showCityNameObject[city.city_name.state.name][city.city_name.name] = city.city_name.id
            });
    },
    methods: {
         checkPermission(){
            return this.pagePermission.add;
        },
        clearCities(cityIndex, stateName, cityName){
            // Deleting Cities only
            let cityIndexFromArray = this.showCityIdArray.indexOf(cityIndex);
            delete this.showCityIdArray[cityIndexFromArray];
            delete this.showCityNameObject[stateName][cityName];
            if(Object.keys(this.showCityNameObject[stateName]).length == 0){
                // deleting State
                delete this.showCityNameObject[stateName];
            }
        },
        clearStates(stateName, stateId){
            this.showStatesNameArray.splice(this.showStatesNameArray.indexOf(stateName),1);
            this.showStatesIdArray.splice(this.showStatesIdArray.indexOf(stateId),1)
            delete this.cityObject[stateName];
            delete this.showCityNameObject[stateName];
            this.select_city = '';
        },
        async selectCountry(e){
            let countryId = e.target.value;
            if(countryId){
                this.stateArray = await getRequest(`getStates?country_id=${countryId}`);
            }
            
        },
        async selectState(e){
            let statename = e.target.options[e.target.options.selectedIndex].dataset.statename;
            let stateId = e.target.value;
            if(this.showStatesNameArray.indexOf(statename) == -1 && stateId){
                this.showStatesNameArray.push(statename);
                this.showStatesIdArray.push(stateId)
                if(stateId){
                    // making dynamic city object
                    this.cityObject[statename] = await getRequest(`getCities?country_id=${this.select_country}&state_id=${stateId}`);
                }
            }
        },
        selectCity(e){
            let cityName = e.target.options[e.target.options.selectedIndex].dataset.cityname;
            let stateName = e.target.options[e.target.options.selectedIndex].dataset.statename;
            let cityId = e.target.value;
            if(this.showCityNameObject[stateName] === undefined && cityId){
                this.showCityNameObject[stateName] = {};
                this.showCityNameObject[stateName][cityName] = cityId;
            } else if(cityId) {
                this.showCityNameObject[stateName][cityName] = cityId;
            }
            if(this.showCityIdArray.indexOf(cityId) == -1){
                this.showCityIdArray.push(cityId);
           }
        },
        getImage(e){
            this.promotional_image = e.target.files[0];
        },
        onSubmit: lodash.debounce(
            async function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let from_date = getTimeStampFromDate(this.from_date);
                let to_date = getTimeStampFromDate(this.to_date);
                
                if(from_date > to_date) {
                    alert("'To Date' Should be greater than 'From Date'");
                    return false;
                } else {
                    let fd = new FormData();
                    let formDataObject = {
                        title:this.title,
                        type: this.select_type,
                        description : this.description,
                        donation_limit : this.max_limit,
                        company_name : this.name_of_organization_company,
                        company_address : this.address_of_organization_company,
                        email : this.email_of_organization,
                        set_background_image : this.set_image_as_background,
                        start_date : this.from_date,
                        end_date : this.to_date,
                        need_inspection : this.select_need_inspection,
                        is_active : this.select_status,
                    };
                    
                    // sending array
                    this.showCityIdArray.forEach(item => {
                        fd.append('cities[]', item);
                    });

                    // appending image in the form object
                    for (let key in formDataObject) {
                        fd.append(key, formDataObject[key]);
                    }

                    // validation for checking image
                    if(this.promotional_image != null){
                        // for adding image in form object
                        fd.append('image', this.promotional_image, this.promotional_image.name);    
                    }

                    fd.append('_method','PUT');

                   let responseData =  await putRequestForImage(`admin/campaign/${this.paramId}`,fd);
                    if(responseData.status === 200 || responseData.status === 201) {
                        this.show('Campaign Updated Successfully','success', 3000);
                        setTimeout(() => {
                            this.$router.go(-1);
                        }, 500);
                    } else {
                        if(responseData['cities'] !== undefined) {
                            this.show('Please Select Cities','error', 3000);  
                        } else {
                            this.show('Campaign does not created','error', 3000);   
                        }
                    }
                }    
            }
        }, 300),
    },
     created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
};
</script>