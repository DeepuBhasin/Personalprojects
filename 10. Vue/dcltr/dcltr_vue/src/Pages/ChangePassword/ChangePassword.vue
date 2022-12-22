<template>
<div class="content-wrapper" style="min-height: 242px">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div v-if="serverError" class="alert" :class="'alert-' + alertColor" role="alert">
                                    {{ serverMessage }}
                                </div>

                                <div class="form-group">
                                    <label for="oldPassword">Old Password</label>
                                    <input type="password" class="form-control oldPassword" id="oldPassword" name="oldPassword" placeholder="Enter Old Password" v-model.trim="oldPassword" ref="oldPassword" />
                                </div>
                                <p v-if="
                      v$.oldPassword.$dirty && v$.oldPassword.required.$invalid
                    " class="text-danger error-message">
                                    {{ v$.oldPassword.required.$message }}
                                </p>
                                <p v-else-if="
                      v$.oldPassword.$error && v$.oldPassword.minLength
                    " class="text-danger error-message">
                                    {{ v$.oldPassword.minLength.$message }}
                                </p>

                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control newPassword" id="newPassword" name="newPassword" placeholder="Enter New Password" v-model.trim="newPassword" />
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
            </div>
        </div>
    </section>
</div>
</template>

<script>
import {
    mapActions
} from "vuex";
import useVuelidate from "@vuelidate/core";
import {
    required,
    helpers,
    minLength,
    sameAs
} from "@vuelidate/validators";

import lodash from "lodash";
export default {
    name: "ChangePassword",
    data() {
        return {
            oldPassword: "",
            newPassword: "",
            confirmPassword: "",
            serverError: false,
            serverMessage: "",
            alertColor: "",
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    validations() {
        return {
            oldPassword: {
                required: helpers.withMessage(
                    "Old Password field cannot be empty",
                    required
                ),
                minLength: helpers.withMessage(
                    "Please enter more than 6 letters",
                    minLength(6)
                ),
            },
            newPassword: {
                required: helpers.withMessage(
                    "New Password field cannot be empty",
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
        };
    },
    //    inject: ['show', 'hide'],
    methods: {
        ...mapActions("users", ["changePassword"]),
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    current_password: this.oldPassword,
                    password: this.newPassword,
                    password_confirmation: this.confirmPassword,
                };
                this.changePassword(userObject)
                    .then(() => {
                        
                        this.$nextTick(() => { this.v$.$reset() })
                        this.oldPassword= "",
                        this.newPassword= "",
                        this.confirmPassword= "",
                        
                        // this.show('Password Changed successfully','success', 3000)
                        this.serverError = true;
                        this.serverMessage = "Password Changed Successfully";
                        this.alertColor = "success";
                    })
                    .catch((err) => {
                        let errorMessage = String(err);
                        if(errorMessage.search('401')){
                            this.serverMessage = "Old Password do not matched ";    
                        }else {
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
