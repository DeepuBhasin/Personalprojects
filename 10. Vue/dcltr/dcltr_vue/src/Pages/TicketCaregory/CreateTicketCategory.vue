<template>
    <SectionHeader header="Create Ticket Category" :titleBoolen="false">
        <template v-slot:breadCrumbsLinks>
                        <li class="breadcrumb-item active">
                            <router-link to="/viewticketcategory">Ticket Category</router-link>
                        </li>
                        <li class="breadcrumb-item active">Create Ticket Category</li>
        </template>
        <template v-slot:body>
            <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off"  class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <textarea class="form-control name" id="name" name="name" placeholder="Enter Cateory Name" v-model.trim="name" />
                    </div>
                  <p
                    v-if="v$.name.$dirty && v$.name.required.$invalid"
                    class="text-danger error-message"
                  >
                    {{ v$.name.required.$message }}
                  </p>
                  <p
                    v-else-if="v$.name.$error && v$.name.minLength"
                    class="text-danger error-message"
                  >
                    {{ v$.name.minLength.$message }}
                  </p>
                  <button
                    type="submit"
                    name="change"
                    id="change"
                    class="btn btn-success"
                  >
                    Create
                  </button>
                  &nbsp;
                  <button type="reset" class="btn btn-danger">Clear</button>
                </div>
             </form>
         </template>
    </SectionHeader> 
</template>             

<script>
import {mapState} from 'vuex'
import {api} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "CreateTicketCategory",
    data() {
        return {
            name: "",
        };
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    computed: {
        ...mapState('users', {
            pagePermission: (state) => {
                return {
                    add: state.permission?.ticket_category?.includes('add') ? true : false
                }
            }
        }),
    },
    validations() {
        return {
            name: {
                required: helpers.withMessage("Category Name field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
        };
    },
    inject: ['show', 'hide'],
    methods: {
        checkPermission() {
            return this.pagePermission.add;
        },

        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    name: this.name,
                };

                api.post('admin/ticketCategory', userObject).then(() => {
                    this.$nextTick(() => {
                        this.v$.$reset()
                    })
                    this.name = "";
                    
                    this.show('Ticket Category Created Successfully','success', 3000);
                    
                    setTimeout(() => {
                        this.$router.push('viewticketcategory');
                    }, 500);

                }).catch((err) => {
                    let errorMessage = String(err);
                    if (errorMessage.search('422')) {
                        this.show('Ticket Category already  exist','error', 3000);   
                    } else { 
                        this.show('Ticket Category do not created','error', 3000);
                    }
                });
            }
        }, 300),
    },
    created() {
        if (!this.checkPermission()) {
            this.$router.push('/dashboard');
        }
    },
};
</script>

<style>
</style>
