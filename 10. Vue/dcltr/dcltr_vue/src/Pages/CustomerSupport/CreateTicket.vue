<template>
    <SectionHeader header="Create Ticket" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/customersupport">Customer Support</router-link>
            </li>
            <li class="breadcrumb-item active">Create Ticket</li>
         </template> 
         <template v-slot:title>
            <h3 class="card-title">Create Ticket</h3>
        </template>   
          <template v-slot:body>   
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off" class="col-md-12">
                    <div class="col-md-6">
                        <div v-if="serverError" class="alert" :class="'alert-' + alertColor" role="alert">
                        </div>
                        <div class="form-group">
                            <label for="title">Ticket Title</label>
                            <input type="text" class="form-control title" id="title" name="title" placeholder="Enter Ticket title" v-model.trim="title" />
                        </div> 
                        <p v-if="v$.title.$dirty && v$.title.required.$invalid" class="text-danger error-message">
                            {{ v$.title.required.$message }}
                        </p>
                        <p v-else-if="v$.title.$error && v$.title.minLength" class="text-danger error-message">
                            {{ v$.title.minLength.$message }}
                        </p> 
                        <div class="form-group">
                            <label for="select_ticket_category">Ticket Category</label>
                            <select class="form-control select_ticket_category" id="select_ticket_category" name="select_ticket_category" v-model.trim="select_ticket_category">
                                <option value="">Select Ticket Category</option>
                                    <option v-for="item in ticket_category_list" :key="item.id" :value="item.id" >{{item.name}}</option>
                            </select>
                        </div>
                        <p v-if="v$.select_ticket_category.$dirty && v$.select_ticket_category.required.$invalid" class="text-danger error-message">
                            {{ v$.select_ticket_category.required.$message }}
                        </p>
                        <div class="form-group">
                            <label for="select_ticket_category">User</label>
                            <v-select v-model="user_id"  :options="user_list" :reduce="(option) => option.id" label="nameEmail"  placeholder="Select User"  ></v-select>
                        </div>  
                        
                        <p v-if="v$.user_id.$dirty && v$.user_id.required.$invalid" class="text-danger error-message">
                            {{ v$.user_id.required.$message }}
                        </p>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select class="form-control priority" id="priority" name="priority" v-model.trim="select_priority">
                                <option value="">Select Priority</option>
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">High</option>
                            </select>
                        </div>
                            <p v-if="v$.select_priority.$dirty && v$.select_priority.required.$invalid" class="text-danger error-message">
                            {{ v$.select_priority.required.$message }}
                        </p>
                            <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control message" id="message" name="message" placeholder="Enter Message" v-model.trim="message" rows="8" />
                        </div>
                            <p v-if="v$.message.$dirty && v$.message.required.$invalid" class="text-danger error-message">
                            {{ v$.message.required.$message }}
                        </p>
                        <p v-else-if="v$.message.$error && v$.message.minLength" class="text-danger error-message">
                            {{ v$.title.minLength.$message }}
                        </p> 

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
import {mapState} from 'vuex'
import {api, getRequest} from "@/store/api.js";
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "CreateTicket",
    data() {
        return {
            title: "",
            user_list : [],
            user_id : "",
            select_ticket_category : "",
            ticket_category_list : [],
            select_priority  : "",
            message : "",
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
                      add :  state.permission?.customer_support?.includes('add')  ? true : false
                  }
              }
          }),
    },
    validations() {
        return {
            title: {
                required: helpers.withMessage("Ticket Title field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },
            user_id: {
                required: helpers.withMessage("User field cannot be empty", required),
            },
            select_ticket_category: {
                required: helpers.withMessage("Ticket Category  field cannot be empty", required),
            },
            select_priority: {
                required: helpers.withMessage("Priority field cannot be empty", required),
            },
            message: {
                required: helpers.withMessage("Message field cannot be empty", required),
                minLength: helpers.withMessage(
                    "Please enter more than 5 letters",
                    minLength(5)
                ),
            },

        };
    },
    inject: ['show', 'hide'],
    async  mounted() {
      this.ticket_category_list =   await getRequest(`admin/ticketCategory`);
      let userList = await api.get("admin/userList");
      let userListArray = userList.data;
        for(let i in userListArray){
            userListArray[i]['nameEmail']  = `${userListArray[i].phone_number} (${userListArray[i].email})`;
        }
        this.user_list = userListArray;
    },
    methods: {
         checkPermission(){
            return this.pagePermission.add;
        },
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    title: this.title,
                    message: this.message,
                    category_id: this.select_ticket_category,
                    priority: this.select_priority,
                    user_id : this.user_id,
                    status : 1,
                };
                
                api.post('admin/ticket', userObject).then(() => {
                    this.$nextTick(() => { this.v$.$reset() })
                    this.title = "";
                    this.select_ticket_category = "",
                    this.user_id  = "";
                    this.priority = [];
                    this.message = "";
                    this.show('Ticket Created Successfully','success', 3000);
                    setTimeout(()=>{
                    this.$router.push ('/customersupport');
                },500);
                }).catch((err) => {
                    this.show('Ticket do not created','error', 3000);
                });
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