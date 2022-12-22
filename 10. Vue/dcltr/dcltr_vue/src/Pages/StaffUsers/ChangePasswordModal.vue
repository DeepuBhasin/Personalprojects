<template>
<form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="newPassword">Password</label>
                    <input type="password" class="form-control newPassword" id="newPassword" name="newPassword" placeholder="Enter Password" v-model.trim="newPassword" />
                </div>
                <p v-if="v$.newPassword.$dirty && v$.newPassword.required.$invalid" class="text-danger error-message">
                    {{ v$.newPassword.required.$message }}
                </p>
                <p v-else-if="v$.newPassword.$error && v$.newPassword.minLength" class="text-danger error-message">
                    {{ v$.newPassword.minLength.$message }}
                </p>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control confirmPassword" id="confirmPassword" name="confirmPassword" placeholder="Enter Confirm Password" v-model.trim="confirmPassword" />
                </div>
                <p v-if="
              v$.confirmPassword.$dirty && v$.confirmPassword.required.$invalid
            " class="text-danger error-message">
                    {{ v$.confirmPassword.required.$message }}
                </p>
                <p v-else-if="
              v$.confirmPassword.$error && v$.confirmPassword.sameAsPassword
            " class="text-danger error-message">
                    {{ v$.confirmPassword.sameAsPassword.$message }}
                </p>
                <!-- <p v-if="v$.confirmPassword.$error && v$.confirmPassword.minLength" class="text-danger error-message">{{v$.confirmPassword.minLength.$message}}</p> -->

                <div class="form-group">
                    <button type="submit" name="change" id="change" class="btn btn-primary">
                        Change
                    </button>
                    &nbsp;
                    <button type="reset" class="btn btn-danger">Clear</button>
                </div>
            </div>
        </div>
    </div>
</form>
</template>

<script>
import {mapActions} from 'vuex';
import useVuelidate from "@vuelidate/core";
import {
    required,
    helpers,
    minLength,
    sameAs
} from "@vuelidate/validators";
import {api} from '@/store/api'
import lodash from "lodash";
export default {
    name: "ChangePassword",
    props:["id"],
    data() {
        return {
            newPassword: "",
            confirmPassword: "",
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    mounted(){
            this.newPassword= "";
            this.confirmPassword= "";
    },
    validations() {
        return {
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
                    "Password and Confirm Password dont matched",
                    sameAs(this.newPassword)
                ),
                minLength: helpers.withMessage(
                    "Please enter more than 6 letters",
                    minLength(6)
                ),
            },
        };
    },
    methods: {
        ...mapActions('helpers',[
            'refresh',
        ]),
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    password: this.newPassword,
                    password_confirmation: this.confirmPassword,
                };
                api.put('admin/changeUserPassword/'+this.id,userObject)
                    .then((response) => {
                        // this.show('Password Changed successfully','success', 3000)

                       this.$nextTick(() => { this.v$.$reset() })
                       this.newPassword =  "";
                       this.confirmPassword =  "";
                       this.refresh({data:{message:response.data.message, status:true}})
                    })
                    .catch((err) => {
                        let errorMessage = String(err);
                        if (errorMessage.search("401")) {
                            this.serverMessage = "Old Password do not matched ";
                        } else {
                            this.serverMessage = "Password do not Changed ";
                        }
                        // this.show(err.message, 3000)})
                        this.serverError = true;
                        this.alertColor = "danger";
                    });

                setTimeout(() => {
                    this.serverError = false;
                }, 3000);
                
            }
        }, 300),
    },
};
</script>

<style>
</style>
