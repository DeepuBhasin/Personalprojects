<template>
    <SectionHeader header="Bank Details" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                Bank Details
            </li>
        </template>
        <template v-slot:title>
            <h3 class="card-title">Bank Details</h3>
        </template>
        <template v-slot:body>
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
                        <template v-if="bankStatus">update</template>
                        <template v-else>Submit</template>
                    </button>
                </div>
            </div>
        </form>
    </template>        
</SectionHeader>
</template>

<script>
import {getRequest,postRequest,putRequest} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,maxLength,numeric} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "AddAdmin",
    data() {
        return {
            user_id : '',
            bankStatus : false,
            account_holder_name : "",
            bank_name : "",
            account_number : "",
            bank_ifsc_code : '',
            bank_address : '',
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    validations() {
        return {
            account_holder_name: {
                required: helpers.withMessage("Account Holder Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
            bank_name: {
                required: helpers.withMessage("Bank Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
            account_number: {
                required: helpers.withMessage(
                    "Account Number field cannot be empty",
                    required
                ),
                numeric: helpers.withMessage(
                    "Please enter only numbers",
                    numeric
                ),
            },
            bank_ifsc_code: {
               required: helpers.withMessage("Bank IFSC field cannot be empty", required),
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
                required: helpers.withMessage("Bank Address field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 4 letters",
                    minLength(4)
                ),
            },
        };
    },
    inject: ['show', 'hide'],
    async mounted() {
    
    let bankResponse     = await getRequest("admin/bankDetail");
    
    if(bankResponse !== undefined)
        {
            this.bankStatus = true;
            this.account_holder_name = bankResponse.account_holder_name;
            this.bank_name = bankResponse.bank_name;
            this.account_number = bankResponse.account_number;
            this.bank_ifsc_code = bankResponse.ifsc_code;
            this.bank_address = bankResponse.address;
            this.user_id = bankResponse.user_id;
        }
    },
    
    methods: {
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
                
                if(this.bankStatus == false) {
                    let updateBankResponse = await postRequest(`admin/bankDetail/user`, userObject);
                        if(updateBankResponse?.status ===200 ){
                            this.show('Bank Details Added successfully','success', 3000);
                        } else {
                            this.show('Bank Details do not added','error', 3000);
                        }
                } else {
                    let updateBankResponse = await putRequest(`admin/bankDetail/userupdate`, userObject);
                    if(updateBankResponse?.status ===200 ){
                            this.show('Bank Details updated successfully','success', 3000);
                        } else {
                            this.show('Bank Details do not updated','error', 3000);
                        }
                }
             }
        }, 300),
    },
    
};
</script>
