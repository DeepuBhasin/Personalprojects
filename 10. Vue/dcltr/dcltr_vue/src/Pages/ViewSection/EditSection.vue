<template>
<div class="content-wrapper" style="min-height: 242px">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Section</h1>
                </div>
                <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="/viewsection">Section Management</router-link>
                        </li>
                        <li class="breadcrumb-item active">Edit Section</li>
                    </ol>
                </div>
            </div>
             <!-- <div  class="row">
                <a class="btn btn-info btn-xs pull-right" @click="$router.go(-1)">Back</a>
            </div> -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
                    <div class="card-body toggleBtnOuter">
                        <div class="row">
                            <div class="col-md-6">
                                <div v-if="serverError" class="alert" :class="'alert-' + alertColor" role="alert">
                                    {{ serverMessage }}
                                </div>

                                <div class="form-group">
                                    <label for="name"> Permission Name</label>
                                    <input type="text" class="form-control name capital" id="name" name="name" placeholder="Enter Name" v-model.trim="name" />
                                </div>
                                <p v-if="v$.name.$dirty && v$.name.required.$invalid" class="text-danger error-message">
                                    {{ v$.name.required.$message }}
                                </p>
                                <p v-else-if="v$.name.$error && v$.name.minLength" class="text-danger error-message">
                                    {{ v$.name.minLength.$message }}
                                </p>
                                
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchpage"  v-model="permissionModel" value="page">
                                        <label class="custom-control-label" for="customSwitchpage">Page Permission</label>
                                        </div>
                                </div>

                                 <div class="form-group">
                                    <!-- <label for="customSwitchAdd">Add Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchAdd"  v-model="permissionModel" value="add">
                                        <label class="custom-control-label" for="customSwitchAdd">Add Permission</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                     <!-- <label for="customSwitchview">View Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchview"  v-model="permissionModel" value="view">
                                        <label class="custom-control-label" for="customSwitchview" >View Permission</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="customSwitchEdit">Edit Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchEdit"  v-model="permissionModel" value="edit">
                                        <label class="custom-control-label" for="customSwitchEdit">Edit Permission</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchDelete"  v-model="permissionModel" value="delete">
                                        <label class="custom-control-label" for="customSwitchDelete">Delete Permission</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchpassword"  v-model="permissionModel" value="password">
                                        <label class="custom-control-label" for="customSwitchpassword"> Change Password</label>
                                        </div>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchblock"  v-model="permissionModel" value="block">
                                        <label class="custom-control-label" for="customSwitchblock"> Block User</label>
                                        </div>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchpro_normal"  v-model="permissionModel" value="pro_normal">
                                        <label class="custom-control-label" for="customSwitchpro_normal"> Pro/Normal User</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchlink_form"  v-model="permissionModel" value="link_form">
                                        <label class="custom-control-label" for="customSwitchlink_form"> Link Form</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchManageSearch"  v-model="permissionModel" value="manage_search">
                                        <label class="custom-control-label" for="customSwitchManageSearch"> Manage Search</label>
                                        </div>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchApprove"  v-model="permissionModel" value="approve">
                                        <label class="custom-control-label" for="customSwitchApprove"> Approve</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchReject"  v-model="permissionModel" value="reject">
                                        <label class="custom-control-label" for="customSwitchReject"> Reject</label>
                                        </div>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchclose"  v-model="permissionModel" value="close">
                                        <label class="custom-control-label" for="customSwitchclose"> Close</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchreopen"  v-model="permissionModel" value="reopen">
                                        <label class="custom-control-label" for="customSwitchreopen"> Reopen</label>
                                        </div>
                                </div>
                                 <div class="form-group">
                                    <!--<label for="customSwitchDelete">Delete Permission</label> -->
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitchactive"  v-model="permissionModel" value="active">
                                        <label class="custom-control-label" for="customSwitchactive">Active</label>
                                        </div>
                                </div>
                                <br><br>
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
import {api} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {
    required,
    helpers,
    minLength,
} from "@vuelidate/validators";

import lodash from "lodash";
export default {
    name: "CreateSection",
    data() {
        return {
            name: "",
            permissionModel : [],
            serverError: "",
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
            name: {
                required: helpers.withMessage("Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            
        };
    },
    //    inject: ['show', 'hide'],
     async mounted() {

        let id = this.$route.params.id;
        api.get('admin/section/'+id).then((data)=>data).then(data=>{
            let response = data.data.data;
            this.name = response.name;
            this.permissionModel = response.permission;
            }).catch(error=>{
            console.log(error);
        })
     }, 
    methods: {
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let id = this.$route.params.id;

                let userObject = {
                    name: this.name.toLowerCase(),
                    key: this.name.toLowerCase().replace(/ /g,"_"),
                    permission : JSON.stringify(this.permissionModel.sort()),
                };

                api.patch('admin/section/'+id, userObject).then(() => {
                    // this.show('Password Changed successfully','success', 3000)
                    this.serverError = true;
                    this.serverMessage = "Section Updated Successfully";
                    this.alertColor = "success";
                }).catch((err) => {
                    let errorMessage = String(err);

                    if (errorMessage.includes('422')) {
                        this.serverMessage = 'Section already registed with current Email id or Phone Number';
                    } else {
                        this.serverMessage = 'Section do not Created';
                    }

                    // this.show(err.message, 3000)})
                    this.serverError = true;
                    this.alertColor = "danger";
                });

                setTimeout(() => {
                    this.serverError = false;
                }, 3000);
                setTimeout(()=>{
                    this.$router.go(-1);
                },500);
            }
        }, 300),
    },
};
</script>

<style>
</style>
