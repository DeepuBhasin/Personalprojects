<template>
<SectionHeader header="Edit Ticket Category" :titleBoolen="false">
     <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/viewticketcategory">Ticket Category</router-link>
            </li>
            <li class="breadcrumb-item active">Edit Ticket Category</li>
    </template>
    <template v-slot:body>
        <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off"  class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <textarea class="form-control name" id="name" name="name" placeholder="Enter Cateory Name" v-model.trim="name" />
                    </div>
                  <p v-if="v$.name.$dirty && v$.name.required.$invalid" class="text-danger error-message">
                    {{ v$.name.required.$message }}
                  </p>
                  <p v-else-if="v$.name.$error && v$.name.minLength" class="text-danger error-message">
                    {{ v$.name.minLength.$message }}
                  </p>
                  <button
                    type="submit"
                    name="change"
                    id="change"
                    class="btn btn-success"
                  >
                    Update
                  </button>
                </div>
             </form>
         </template>
    </SectionHeader> 
</template>             

<script>
import { mapState} from 'vuex'
import { api } from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "EditTicketCategory",
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
                    edit: state.permission?.ticket_category?.includes('edit') ? true : false

                }
            }
        }),
    },
    mounted(){
        let id = this.$route.params.id;
        api.get('admin/ticketCategory/'+id).then((result)=>{
            return result;
        }).then((result)=>
            this.name = result.data.data.name
        )
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
            return this.pagePermission.edit;
        },

        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let id = this.$route.params.id;

                let userObject = {
                    name: this.name,
                };
                api.put('admin/ticketCategory/'+id, userObject).then(() => {
                    this.$nextTick(() => {
                        this.v$.$reset()
                    })
                    this.name = "";
                    this.show('Ticket Category Updated Successfully','success', 3000)
                }).catch((err) => {
                    let errorMessage = String(err);
                    if (errorMessage.search('422')) {
                            this.show('Ticket Category already  exist','error', 3000);   
                        } else { 
                            this.show('Ticket Category do not update','error', 3000);
                        }
                });
                
                setTimeout(()=>{
                    this.$router.go(-1);
                },500);

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
