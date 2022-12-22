<template>
    <SectionHeader header="Create Staff User" :titleBoolen="false">
         <template v-slot:breadCrumbsLinks>
             <li class="breadcrumb-item active">
                            <router-link to="/staffusers">Staff Users</router-link>
            </li>
            <li class="breadcrumb-item">
                Edit Staff
            </li>
         </template>
        <template v-slot:body> 
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" :class="homeValue ? 'active' : ''"  @click="tabClick(true,false)">Genrel Setting</button>
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
                            <div v-if="serverError" class="alert" :class="'alert-' + alertColor" role="alert">
                                {{ serverMessage }}
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control name" id="name" name="name" placeholder="Enter Name" v-model.trim="name" />
                                    <p v-if="v$.name.$dirty && v$.name.required.$invalid" class="text-danger error-message">
                                    {{ v$.name.required.$message }}
                                </p>
                                <p v-else-if="v$.name.$error && v$.name.minLength" class="text-danger error-message">
                                    {{ v$.name.minLength.$message }}
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control email" id="email" name="email" placeholder="Enter Email " v-model.trim="email" />
                                    <p v-if="v$.email.$dirty && v$.email.required.$invalid" class="text-danger error-message">
                                    {{ v$.email.required.$message }}
                                </p>
                                <p v-if="v$.email.$dirty && v$.email.email.$invalid" class="text-danger error-message">
                                    {{ v$.email.email.$message }}
                                </p>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control phone_number" id="phone_number" name="phone_number" placeholder="Enter Phone Number" v-model.trim="phone_number" />
                                                <p v-if="
                                    v$.phone_number.$dirty &&
                                    v$.phone_number.required.$invalid
                                " class="text-danger error-message">
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
                            </div>
                            <div class="form-group">
                                <label for="role">Profile</label>
                                <select class="form-control role capital" id="role" name="role" v-model.trim="select">
                                    <option value="">Select Profile</option>
                                    <option v-for="item in role" :key="item.id" :value="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                                <p v-if="v$.select.$dirty && v$.select.required.$invalid" class="text-danger error-message">
                                    {{ v$.select.required.$message }}
                                </p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="change" id="change" class="btn btn-success">
                                    Update
                                </button>
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
                                <button type="submit" name="change" id="change" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </SectionHeader>    
</template>
<script>
import {mapState} from 'vuex';
import {getRequest,putRequest,postRequest} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,email,maxLength,numeric} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "EditAdmin",
    data() {
        return {
            paramId : '',
            name: "",
            email: "",
            phone_number: "",
            role: [],
            select: "",
            newPassword: "",
            password_confirmation: "",
            bankStatus : false,
            account_holder_name : "",
            bank_name : "",
            account_number : "",
            bank_ifsc_code : '',
            bank_address : '',
            homeValue : true,
            profileValue : false,
        
        };
    },
    computed:{
       ...mapState('users', {
              pagePermission : (state) =>{ 
                  return {
                      edit :  state.permission?.staff_users?.includes('edit')  ? true : false
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
        this.paramId = this.$route.params.id;
        let response = await getRequest(`admin/userDetail/+${this.paramId}`); 
            this.name = response.name;
            this.email = response.email;
            this.phone_number = response.phone_number;
            this.select = response.role.id;
            this.created_date = response.created_at;
            this.password = response.password,
            this.password_confirmation = response.password_confirmation
        
        this.role = await getRequest("/admin/role");
        let bankResponse = await getRequest(`admin/bankDetail?user_id=${this.paramId}`);
        
        if(bankResponse !== undefined)
        {
            this.bankStatus = true;
            this.account_holder_name = bankResponse.account_holder_name;
            this.bank_name = bankResponse.bank_name;
            this.account_number = bankResponse.account_number;
            this.bank_ifsc_code = bankResponse.ifsc_code;
            this.bank_address = bankResponse.address;
        }
    },
    created () {
        if(!this.checkPermission()){
            this.$router.push('/dashboard');
        } 
    },
    methods: {
        tabClick(homeValue,profileValue){
            this.homeValue = homeValue;
            this.profileValue = profileValue;
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
                let userObject = {
                    name: this.name,
                    email: this.email,
                    phone_number: this.phone_number,
                    role_id: this.select,
                    password: this.password,
                    password_confirmation: this.password_confirmation

                };
                
                let updateGeneralSettingResponse = await putRequest(`admin/updateDetails/${this.paramId}`, userObject);
                if (updateGeneralSettingResponse?.status === 200) {
                    this.show("Staff's General Setting updated Successfully",'success', 3000);
                } else {
                    this.show("Staff's General Setting  do not update","error", 3000);
                }
                setTimeout(()=>{
                    this.$router.go(-1);
                },500);
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
                    user_id : this.paramId,
                };
                
                if(this.bankStatus == false) {
                    let updateBankResponse = await postRequest(`admin/bankDetail/user`, userObject);
                        if(updateBankResponse?.status ===200 ){
                            this.show('Staff Bank Details Added successfully','success', 3000);
                        } else {
                            this.show('Staff Bank Details do not added','error', 3000);
                        }
                } else {
                    let updateBankResponse = await putRequest(`admin/bankDetail/userupdate`, userObject);
                    if(updateBankResponse?.status ===200 ){
                            this.show('Staff Bank Details updated successfully','success', 3000);
                        } else {
                            this.show('Staff Bank Details do not updated','error', 3000);
                        }
                }
                setTimeout(()=>{
                    this.$router.go(-1);
                },500);
            }
        }, 300),
    },
};
</script>
