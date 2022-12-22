<template>
    <SectionHeader header="Create Staff User" :titleBoolen="false">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
            <router-link to="/staffusers">Staff Users</router-link>
            </li>
            <li class="breadcrumb-item active">
                Create Staff User
            </li>
         </template>
        <template v-slot:body>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" :class="homeValue ? 'active' : ''"  @click="tabClick(true,false)">User Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" :class="profileValue ? 'active' : ''"  @click="tabClick(false,true)">Bank Details</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" :class="homeValue ? 'active show' : ''"  id="home" role="tabpanel" aria-labelledby="home-tab">
            <br/>    
            <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off" class="col-md-12">
                <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control name" id="name" name="name" placeholder="Enter Name" v-model.trim="name" />
                            </div>
                            <p v-if="v$.name.$dirty && v$.name.required.$invalid" class="text-danger error-message">
                                {{ v$.name.required.$message }}
                            </p>
                            <p v-else-if="v$.name.$error && v$.name.minLength" class="text-danger error-message">
                                {{ v$.name.minLength.$message }}
                            </p>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control email" id="email" name="email" placeholder="Enter Email " v-model.trim="email" />
                            </div>
                            <p v-if="v$.email.$dirty && v$.email.required.$invalid" class="text-danger error-message">
                                {{ v$.email.required.$message }}
                            </p>
                            <p v-if="v$.email.$dirty && v$.email.email.$invalid" class="text-danger error-message">
                                {{ v$.email.email.$message }}
                            </p>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control phone_number" id="phone_number" name="phone_number" placeholder="Enter Phone Number" v-model.trim="phone_number" />
                            </div>
                            <p v-if="v$.phone_number.$dirty && v$.phone_number.required.$invalid" class="text-danger error-message">
                                {{ v$.phone_number.required.$message }}
                            </p>
                            <p v-else-if="
                    v$.phone_number.$error && v$.phone_number.numeric
                " class="text-danger error-message">
                                {{ v$.phone_number.numeric.$message }}
                            </p>
                            <p v-else-if="
                    v$.phone_number.$error && v$.phone_number.minLength
                " class="text-danger error-message">
                                {{ v$.phone_number.minLength.$message }}
                            </p>
                            <p v-else-if="
                    v$.phone_number.$error && v$.phone_number.maxLength
                " class="text-danger error-message">
                                {{ v$.phone_number.maxLength.$message }}
                            </p>
                            <div class="form-group">
                                <label for="role">Profile</label>
                                <select class="form-control role" id="role" name="role" v-model.trim="select" style="  text-transform: capitalize;">
                                    <option value="">Select Profile</option>
                                    <option v-for="item in role" :key="item.id" :value="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                            <p v-if="v$.select.$dirty && v$.select.required.$invalid" class="text-danger error-message">
                                {{ v$.select.required.$message }}
                            </p>

                            <div class="form-group">
                                <label for="newPassword">Password</label>
                                <input type="password" class="form-control newPassword" id="newPassword" name="newPassword" placeholder="Enter Password" v-model.trim="newPassword" />
                            </div>
                            <p v-if="
                    v$.newPassword.$dirty && v$.newPassword.required.$invalid
                " class="text-danger error-message">
                                {{ v$.newPassword.required.$message }}
                            </p>
                            <p v-else-if="
                    v$.newPassword.$error && v$.newPassword.minLength
                " class="text-danger error-message">
                                {{ v$.newPassword.minLength.$message }}
                            </p>

                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control confirmPassword" id="confirmPassword" name="confirmPassword" placeholder="Enter Confirm Password" v-model.trim="confirmPassword" />
                            </div>
                            <p v-if="
                    v$.confirmPassword.$dirty &&
                    v$.confirmPassword.required.$invalid
                " class="text-danger error-message">
                                {{ v$.confirmPassword.required.$message }}
                            </p>
                            <p v-else-if="
                    v$.confirmPassword.$error &&
                    v$.confirmPassword.sameAsPassword
                " class="text-danger error-message">
                                {{ v$.confirmPassword.sameAsPassword.$message }}
                            </p>
                            <div class="form-group">
                                <button type="submit" name="submitUser" id="submitUser" class="btn btn-success">
                                    Submit
                                </button>
                                &nbsp;
                                <button type="reset" class="btn btn-danger">Clear</button>
                            </div>
                        </div>
                    </form>
                     </div>
                        <div class="tab-pane fade" :class="profileValue ? 'active show' : ''" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br/>
                            <form action="" method="post" @submit.prevent="onSubmitBank" autocomplete="off" class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_holder_name">Account Holder Name</label>
                                <input mode="passive" type="text" class="form-control account_holder_name" id="account_holder_name" name="account_holder_name" placeholder="Enter Account Holder Name" v-model.trim="account_holder_name" />
                               <p v-if="v$.account_holder_name.$error && v$.account_holder_name.minLength" class="text-danger error-message">
                                    {{ v$.account_holder_name.minLength.$message }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control bank_name" id="bank_name" name="bank_name" placeholder="Enter Bank Name" v-model.trim="bank_name" />
                                <p v-if="v$.bank_name.$error && v$.bank_name.minLength" class="text-danger error-message">
                                    {{ v$.bank_name.minLength.$message }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control account_number" id="account_number" name="account_number" placeholder="Enter Account Number" v-model.trim="account_number" />
                                    <p v-if="v$.account_number.$error && v$.account_number.numeric" class="text-danger error-message">
                                                    {{ v$.account_number.numeric.$message }}
                                    </p>
                            </div>
                            <div class="form-group">
                                    <label for="bank_ifsc_code">Bank IFSC Code</label>
                                    <input type="text" class="form-control bank_ifsc_code" id="bank_ifsc_code" name="bank_ifsc_code" placeholder="Enter Bank IFSC Code" v-model.trim="bank_ifsc_code" />
                                <p v-if="v$.bank_ifsc_code.$error && v$.bank_ifsc_code.minLength" class="text-danger error-message">
                                    {{ v$.bank_ifsc_code.minLength.$message }}
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="bank_address">Bank Address </label>
                                <textarea class="form-control bank_address" id="bank_address" name="bank_address" placeholder="Enter Bank Address" v-model.trim="bank_address"></textarea>
                                <p v-if="v$.bank_address.$error && v$.bank_address.minLength" class="text-danger error-message">
                                    {{ v$.bank_address.minLength.$message }}
                                </p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="change" id="submitBank" class="btn btn-success">
                                    Submit
                                </button>
                                &nbsp;
                                <button type="reset" class="btn btn-danger">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </template>        
</SectionHeader>
</template>

<script>
import {mapState} from 'vuex'
import {getRequest,postRequest} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,email,maxLength,numeric,sameAs} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "AddAdmin",
    data() {
        return {
            user_id : '',
            name: "",
            email: "",
            phone_number: "",
            role: [],
            select: "",
            newPassword: "",
            confirmPassword: "",
            account_holder_name : "",
            bank_name : "",
            account_number : "",
            bank_ifsc_code : '',
            bank_address : '',
            homeValue : true,
            profileValue : false,
            bankDetailsAccessStatus : false,
            generalDetailsAccessStatus : false
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
                      add :  state.permission?.staff_users?.includes('add')  ? true : false
                      
                  }
              }
          }),
    },
    validations() {
        return {
            name: {
                required: helpers.withMessage("Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 6 letters",
                    minLength(6)
                ),
            },
            email: {
                required: helpers.withMessage("Email field cannot be empty", required),
                email: helpers.withMessage("Email is not valid", email),
            },
            select: {
                required: helpers.withMessage("Profile field cannot be empty", required),
            },
            phone_number: {
                required: helpers.withMessage(
                    "Phone Number field cannot be empty",
                    required
                ),
                minLength: helpers.withMessage(
                    "Please enter only 10 Digits Numbers",
                    minLength(10)
                ),
                maxLength: helpers.withMessage(
                    "Please enter only 10 Digits Numbers",
                    maxLength(10)
                ),
                numeric: helpers.withMessage(
                    "Please enter only 10 digits numbers",
                    numeric
                ),
            },
            newPassword: {
                required: helpers.withMessage(
                    "Password field cannot be empty",
                    required
                ),
                minLength: helpers.withMessage(
                    "Please enter more than 6 letters",
                    minLength(6)
                ),
            },
            confirmPassword: {
                required: helpers.withMessage(
                    "Confirm Password field cannot be empty",
                    required
                ),
                sameAsPassword: helpers.withMessage(
                    "New Password and Confirm Password dont matched",
                    sameAs(this.newPassword)
                ),
                minLength: helpers.withMessage(
                    "Please enter more than 6 letters",
                    minLength(6)
                ),
            },
            account_holder_name: {
                // required: helpers.withMessage("Account Holder Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
            bank_name: {
                // required: helpers.withMessage("Bank Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
            account_number: {
                // required: helpers.withMessage(
                //     "Account Number field cannot be empty",
                //     required
                // ),
                numeric: helpers.withMessage(
                    "Please enter only numbers",
                    numeric
                ),
            },
            bank_ifsc_code: {
               // required: helpers.withMessage("Bank IFSC field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 11 letters",
                    minLength(11)
                ),
                maxLength: helpers.withMessage(
                    "Please enter only 11 letters",
                    maxLength(11)
                ),
            },
            bank_address: {
                //required: helpers.withMessage("Bank Address field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
        };
    },
    inject: ['show', 'hide'],
    async mounted() {
        this.role  = await getRequest("/admin/role");
    },
    
    methods: {
         checkPermission(){
            return this.pagePermission.add;
        },
        tabClick(homeValue,profileValue){
            if(this.bankDetailsAccessStatus == false){
                alert('Please Enter User Details Fields');
                return false;
            } else {
                if(this.generalDetailsAccessStatus == true) {
                    alert('Please Enter Bank Details Fields');
                    return fasle
                }
                this.generalDetailsAccessStatus = true;

            }

            this.homeValue = homeValue;
            this.profileValue = profileValue;
        },
        onSubmit: lodash.debounce(
            async function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    name: this.name,
                    email: this.email,
                    phone_number: this.phone_number,
                    role_id: this.select,
                    password: this.newPassword,
                    password_confirmation: this.confirmPassword,
                };

                let createGeneralSettingResponse =  await postRequest('admin/createAdmin', userObject);
                if (createGeneralSettingResponse?.status === 200 || createGeneralSettingResponse?.status === 201) {
                    this.user_id = createGeneralSettingResponse.data.data.id;
                    // this.$nextTick(() => {this.v$.$reset()})
                    // this.name = "";
                    // this.email = "";
                    // this.phone_number = "";
                    // this.role = [];
                    // this.select = "";
                    // this.newPassword = "";
                    // this.confirmPassword = "";
                  this.show('Staff User Created Successfully','success', 3000);
                   this.bankDetailsAccessStatus = true;
                   this.tabClick(false,true); 
                    

                    // setTimeout(()=>{
                    //     this.$router.push ('/staffusers');
                    // },500);
                
                } else if (createGeneralSettingResponse?.includes('422')) {
                        this.show('Staff user already registed with current Email id or Phone Number','error', 3000)
                } else {
                    this.show('Staff User do not Created','error', 3000)
                }
                
            }
        }, 300),
        onSubmitBank: lodash.debounce(
            async function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    account_holder_name: this.account_holder_name,
                    bank_name: this.bank_name,
                    account_number: this.account_number,
                    ifsc_code: this.bank_ifsc_code,
                    address: this.bank_address,
                    user_id : this.user_id,
                };
                
                let updateBankResponse = await postRequest(`admin/bankDetail/user`, userObject);
                if(updateBankResponse?.status ===200 || updateBankResponse?.status === 201 ){
                    this.show('Staff Bank Details Added successfully','success', 3000);
                        setTimeout(()=>{
                        this.$router.go(-1);
                    },500);
                } else if(updateBankResponse.includes('422')){
                    this.show('Invalid IFSC Code in Bank Account','error', 3000);   
                }
                else {
                    this.show('Staff Bank Details do not added','error', 3000);
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
