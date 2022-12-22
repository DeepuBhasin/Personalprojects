<template>
    <SectionHeader header="Edit Permission" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
            <router-link to="/viewroles">Permission Group</router-link>
            </li>
            <li class="breadcrumb-item active">Edit Permission</li>
         </template>
         <template v-slot:title>
            <h3 class="card-title">Edit Permissions</h3>
        </template>         
        <template v-slot:body> 
            <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off" class="col-md-12">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="addRole">Permission Name</label>
                            <input type="text" class="form-control capital" id="addRole" name="addRole" placeholder="Enter Permission Name" v-model.trim="addRole" />
                        
                                            <p v-if="
                            v$.addRole.$dirty && v$.addRole.required.$invalid
                            " class="text-danger error-message">
                                            {{ v$.addRole.required.$message }}
                                        </p>
                                        <p v-else-if="
                            v$.addRole.$error && v$.addRole.minLength
                            " class="text-danger error-message">
                                            {{ v$.addRole.minLength.$message }}
                                        </p>
                        </div>
                        <div class="form-group">
                            <select class="form-control permissionName capital" id="permissionName" name="permissionName" v-model.trim="permissionName">
                                <option value="">Select Permission</option>
                                <option v-for="(item,index) in checkboxes" :key="index" :value="index">
                                    {{ removeUnderScoreFromString(index) }}
                                </option>
                            </select>
                             <template v-if="permissionName">
                                <div class="custom-control custom-switch" v-if="checkboxes[permissionName].includes('page')">
                                    <br/>
                                    <input type="checkbox" class="custom-control-input" :id="permissionName.toLowerCase()+'#'+'page'" v-model="checkedCheckboxModel" :value="permissionName.toLowerCase()+'#'+'page'"
                                    >
                                    <label class="custom-control-label" :for="permissionName.toLowerCase()+'#'+'page'"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{removeUnderScoreFromString('page')}}</label>
                                </div>
                                <template v-for="(item,index) in checkboxes[permissionName]" :key="index">
                                     <div class="custom-control custom-switch" v-if="item != 'page'">
                                        <br/>
                                        <input type="checkbox" class="custom-control-input" :id="permissionName.toLowerCase()+'#'+item" v-model="checkedCheckboxModel" :value="permissionName.toLowerCase()+'#'+item">
                                        <label class="custom-control-label" :for="permissionName.toLowerCase()+'#'+item"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{removeUnderScoreFromString(item)}}</label>
                                    </div>
                                </template>
                             </template>   
                             <br/>
                        </div>  
                         <!-- <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                    <th>Page Visible</th>
                                    <th>Add</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Block</th>
                                    <th>Change Password</th>
                                    <th>Link Form</th>
                                    <th>Manage Serach</th>
                                    <th>Pro/Normal</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                    <th>Close</th>
                                    <th>Reopen</th>

                                </tr>
                            </thead>
                            <tbody>
                                    <tr v-for="(item,key) in checkboxes" :key="key">
                                    <td class="capital">{{key.replace('_',' ')}}</td>
                                    <td>
                                        <template v-if="item.includes('page')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#page`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('add')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#add`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('view')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#view`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('edit')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#edit`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('delete')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#delete`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                        <td>
                                        <template v-if="item.includes('block')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#block`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('password')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#password`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('link_form')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#link_form`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('manage_search')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#manage_search`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('pro_normal')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#pro_normal`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('approve')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#approve`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('reject')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#reject`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('close')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#close`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('reopen')">
                                            <input type="checkbox" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#reopen`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    
                                </tr>
                            </tbody>
                            
                        </table>-->
                        <div class="form-group">
                            <button type="submit" name="change" id="change" class="btn btn-success btn-sm">
                                Update
                            </button>
                            &nbsp;
                        </div>
                    </div>
                </form>
        </template>
    </SectionHeader>
</template>

<script>
import {mapState} from 'vuex';
import useVuelidate from "@vuelidate/core";
import {getRequest, putRequest} from '@/store/api'
import {removeUnderScore} from '@/Utils/index.js'
import {required,helpers,minLength} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "EditPermission",
    data() {
        return {
            addRole: "",
            permission_id: null,
            checkedCheckboxModel: [],
            checkboxes: [],
            permissionName :'',
            paramId :''
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    validations() {
        return {
            addRole: {
                required: helpers.withMessage(
                    "Permission field cannot be empty",
                    required
                ),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            }
        };
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                        // page :  state.permission?.permission_group?.includes('page')  ? true : false,
                        edit :  state.permission?.permission_group?.includes('edit')  ? true : false
                  }
              }
          }),
    },
    async mounted() {
        this.paramId = this.$route.params.id;
        let responseData = await getRequest(`admin/role/${this.paramId}`);
        this.permission_id = responseData.permission_id
        this.addRole = responseData.name;
        let getcheckBox = responseData.permission;
        let checkedCheckbox = [];
        for (let key in getcheckBox) {
            for (let i in getcheckBox[key]) {
                checkedCheckbox.push(`${key.toLowerCase()}#${getcheckBox[key][i]}`);
            }
        }
        this.checkedCheckboxModel = checkedCheckbox;
        let sectionResponse = await getRequest(`admin/section`);
        let newArray = {};
        for (let key in sectionResponse) {
            newArray[sectionResponse[key].key] = sectionResponse[key].permission;
        }
        this.checkboxes = newArray;
    },
     created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
    inject: ['show', 'hide'],
    methods: {
        removeUnderScoreFromString(string){
           return removeUnderScore(string)
        },
         checkPermission(){
            return this.pagePermission.edit;
        },
        onSubmit: lodash.debounce(
            async function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {

                let userObject = {};
                let finalCheckedArray = this.checkedCheckboxModel;

                for (let i in finalCheckedArray) {
                    let indexofHash = finalCheckedArray[i].indexOf('#');
                    let lastIndex = finalCheckedArray[i].length;
                    let arrayValue = finalCheckedArray[i].substring(indexofHash + 1, lastIndex);
                    let key = finalCheckedArray[i].substring(0, indexofHash);

                    if (userObject[key] === undefined) {
                        userObject[key] = [];
                    }
                    userObject[key].push(arrayValue);
                }
                userObject = JSON.stringify(userObject);
                userObject = {
                    role_name: this.addRole,
                    admin_role_id:  this.paramId,
                    permissions:userObject
                }
                let responseData = await putRequest(`admin/permission/update/${this.permission_id}`,userObject);
               if(responseData.status === 200 || responseData.status === 201) {
                 this.show('Permissions Updated Successfully','success', 3000);
               } else {
                this.show('Permissions do not Updated','error', 3000);
               }
                setTimeout(() => {
                    this.$router.go(-1);
                }, 500);
            }
        }, 300),
    },
};
</script>

<style>
</style>
