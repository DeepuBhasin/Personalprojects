<template>
<div class="content-wrapper" style="min-height: 242px">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">My Profile</li>
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
                                    <label for="username">User Name</label>
                                    <input type="text" class="form-control username" id="username" name="username" placeholder="Enter User Name" v-model.trim="userName"/>
                                </div>
                                 <p v-if="
                      v$.userName.$dirty && v$.userName.required.$invalid
                    " class="text-danger error-message">
                                    {{ v$.userName.required.$message }}
                                </p>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control phone_number" id="phone_number" name="phone_number" placeholder="Enter Phone Number" v-model.trim="phone_number" />
                                </div>
                                 <p v-if="
                      v$.phone_number.$dirty && v$.phone_number.required.$invalid
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
                                      
                                <div class="form-group">
                                    <button type="submit" name="change" id="change" class="btn btn-primary">
                                        Update
                                    </button>

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
    mapState,
    mapActions
} from "vuex";
import useVuelidate from "@vuelidate/core";
import {
    required,
    helpers,
    maxLength,
    minLength,
    numeric
} from "@vuelidate/validators";


import lodash from "lodash";
export default {
    name: "MyProfile",
    data() {
        return {
             serverError: false,
            serverMessage: "",
            alertColor: "",
            userId : '',
            userName : '',
            phone_number : '',
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    validations() {
        return {
            userName: {
                required: helpers.withMessage("Username field cannot be empty", required),
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
                maxLength : helpers.withMessage(
                    "Please enter only 10 Digits Numbers",
                    maxLength(10)
                ),
                 numeric : helpers.withMessage(
                    "Please enter only 10 digits numbers",
                    numeric)
            },
        };
    },
    mounted() {
        let token = localStorage.getItem('token');
          this.$store.dispatch('users/getAdminDetails', token).then((getData)=>{
              this.userName = getData.userName;
              this.phone_number = getData.phone_number;
              this.userId =getData.userId
           });
     },
    // computed: {

    //       userName : {
    //         get () {
    //           return this.$store.state.users.userName
    //         },
    //         set(value) {
    //           this.$store.commit("users/setInputValue",value)
    //           this.userName = this.$store.state.users.userName;
    //         },
    //       phone_number : {
    //         get () {
    //           return this.$store.state.users.phone_number
    //         },
    //          set(value) {
    //           this.phone_number = value
    //         }
    //       },
    // },
    methods: {
       ...mapActions('users', ['updateProfile']),
    onSubmit: lodash.debounce(function (e) {
        this.v$.$validate()
        if (this.v$.$error) {
           return false;

        } else {
          let userObject = {
                id : this.userId,
                name: this.userName,
                phone_number: this.phone_number,
            }
            this.updateProfile(userObject)
                .then(() => {
                        // this.show('Password Changed successfully','success', 3000)
                        this.serverError = true;
                        this.serverMessage = "Profile Update Successfully";
                        this.alertColor = "success";
                    })
                    .catch((err) => {
                        // this.show(err.message, 3000)})
                        this.serverError = true;
                        this.serverMessage = "Profile do not Update";
                        this.alertColor = "danger";
                    });

                setTimeout(() => {
                    this.serverError = false;
                }, 3000);
        }
    }, 300)
    },
};
</script>

<style>
</style>
