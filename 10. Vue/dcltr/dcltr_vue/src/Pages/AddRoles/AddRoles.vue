<template>
<SectionHeader header="Create Permissios" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/viewroles">Permission Group</router-link>
        </li>
        <li class="breadcrumb-item active">Create Permission</li>
    </template>
     <template v-slot:title>
            <h3 class="card-title">Create Permissios</h3>
    </template>    
    <template v-slot:body>
        <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off" class="col-md-12"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="addRole">Permission Name</label>
                        <input type="text" class="form-control addRole" id="addRole" name="addRole" placeholder="Enter Permission Name" v-model.trim="addRole" />
                                <p v-if="v$.addRole.$dirty && v$.addRole.required.$invalid" class="text-danger error-message">
                                {{ v$.addRole.required.$message }}
                            </p>
                            <p v-else-if="v$.addRole.$error && v$.addRole.minLength" class="text-danger error-message">
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
                                             @change="addValue(permissionName,'page')">
                                        <label class="custom-control-label" :for="permissionName.toLowerCase()+'#'+'page'"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{removeUnderScoreFromString('page')}}</label>
                                    </div>
                                <template v-for="(item,index) in checkboxes[permissionName]" :key="index">
                                     <div class="custom-control custom-switch" v-if="item != 'page'">
                                        <br/>
                                        <input type="checkbox" class="custom-control-input" :id="permissionName.toLowerCase()+'#'+item" v-model="checkedCheckboxModel" :value="permissionName.toLowerCase()+'#'+item"
                                             @change="addValue(permissionName,item)">
                                        <label class="custom-control-label" :for="permissionName.toLowerCase()+'#'+item"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{removeUnderScoreFromString(item)}}</label>
                                    </div>
                                </template>
                             </template>   
                             <br/>
                        </div>
                        <!-- <div>
                            <table class="table table-striped table-bordered table-hover text-center">
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
                                            <input type="checkbox"  @change="addValue(key,'page')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#page`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('add')">
                                            <input type="checkbox"  @change="addValue(key,'add')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#add`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('view')">
                                            <input type="checkbox"  @change="addValue(key,'view')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#view`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('edit')">
                                            <input type="checkbox"  @change="addValue(key,'edit')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#edit`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('delete')">
                                            <input type="checkbox"  @change="addValue(key,'delete')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#delete`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                        <td>
                                        <template v-if="item.includes('block')">
                                            <input type="checkbox" @change="addValue(key,'block')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#block`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('password')">
                                            <input type="checkbox" @change="addValue(key,'password')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#password`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('link_form')">
                                            <input type="checkbox"  @change="addValue(key,'lnk_form')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#link_form`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('manage_search')">
                                            <input type="checkbox"  @change="addValue(key,'manage_search')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#manage_search`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('pro_normal')">
                                            <input type="checkbox"  @change="addValue(key,'pro_normal')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#pro_normal`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                        <td>
                                        <template v-if="item.includes('approve')">
                                            <input type="checkbox" @change="addValue(key,'approve')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#approve`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('reject')">
                                            <input type="checkbox" @change="addValue(key,'reject')"  v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#reject`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                        <td>
                                        <template v-if="item.includes('close')">
                                            <input type="checkbox" @change="addValue(key,'close')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#close`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                    <td>
                                        <template v-if="item.includes('reopen')">
                                            <input type="checkbox" @change="addValue(key,'reopen')" v-model="checkedCheckboxModel" :value="`${key.toLowerCase()}#reopen`">
                                        </template>
                                        <template v-else></template>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div> -->
                        <div class="form-group">
                            <button type="submit" name="change" id="change" class="btn btn-success">
                                Create
                            </button>
                            &nbsp;
                            <button type="reset" class="btn btn-danger">Clear</button>
                    </div>
                </div>
        </form>
    </template>
</SectionHeader>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {mapState} from 'vuex';
import {getRequest,postRequest} from '@/store/api'
import {removeUnderScore} from '@/Utils/index.js'
import {required,helpers,minLength} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "AddRoles",
    data() {
        return {
            select: {},
            addRole: "",
            checkboxes: [],
            permissionName : '',
            checkedCheckboxModel : []
        };
    },
    computed:{
    ...mapState('users', {
            pagePermission : (state) =>{ 
                return {
                    add :  state.permission?.permission_group?.includes('add')  ? true : false
                }
            }
        }),
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
   async mounted() {
    let responseData =  await getRequest('admin/section');
        let newArray = {};
        for (let v in responseData) {
            newArray[responseData[v].key] = responseData[v].permission;
        }
        this.checkboxes = newArray;
    },
    created(){
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
            return this.pagePermission.add;
        },
        addValue(key, value) {
            if (this.select[key] === undefined) {
                this.select[key] = [];
                this.select[key].push(value);

            } else {
                if (this.select[key].indexOf(value) === -1) {
                    this.select[key].push(value);
                    this.select[key].sort();

                } else {
                    let index = this.select[key].indexOf(value)
                    this.select[key].splice(index, 1);
                        if (this.select[key].length === 0) {
                        delete this.select[key];
                    }
                }
            }
        },
        onSubmit: lodash.debounce(
            async function (e) {
            this.v$.$validate();
            if (Object.getOwnPropertyNames(this.select).length === 0) {
                alert('Please Select Permissions');
                return false;
            }
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                name: this.addRole
            }
            let responseData =await  postRequest('admin/role', userObject);
            if(responseData.status === 200 || responseData.status === 201) {
                let permissionObject = {
                    admin_role_id: responseData.data.data.id,
                    permissions: JSON.stringify(this.select),
                }    
                let postDataResponse = await postRequest('admin/permission/create', permissionObject);
                console.log(postDataResponse);
                    if(postDataResponse.status === 200 || postDataResponse.status === 201) {
                        this.show(postDataResponse.data.message,'success' ,3000);
                    } else {
                        this.show('Role not Added','error', 3000);
                    }
                    setTimeout(() => {
                        this.$router.push('/viewroles');
                    }, 500);
            } else if (responseData.includes('422')) {
                    this.show(this.addRole + ' already exist','error', 3000);
                } else {
                    this.show('Permission do not Added','error', 3000);
                }
            }
        }, 300),
    },
};
</script>

<style>
</style>
