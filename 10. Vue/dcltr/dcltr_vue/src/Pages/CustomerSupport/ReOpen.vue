<template>
    <SectionHeader header="Reopen Ticket" :titleBoolen="true">
         <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/customersupport">Customer Support</router-link>
            </li>
            <li class="breadcrumb-item">
                Reopen Ticket
            </li>
        </template>
        <template v-slot:title>
            <h3 class="card-title">Reopen Ticket</h3>
        </template>             
        <template v-slot:body>   
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Column</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>Ticket Id</td>
                            <td>#{{ticketData.id}}</td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ticketData.title}}</td>
                        </tr>
                        <tr>
                            <td>Title Category</td>
                            <td>{{categoryName}} </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ticketData.message}}</td>
                        </tr>
                        <tr>
                            <td>Created By</td>
                            <td>{{userName}} ({{userPhone}})</td>
                        </tr>
                        <tr>
                            <td>Priority</td>
                            <td>{{ticketData.priority == 0 ? 'Low' : ticketData.priority == 1 ? 'Medium' : 'High'}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ticketData.status == 0 ? 'Closed' : ticketData.status == 1 ? 'Open' : 'Re-Open'}}</td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>{{convertDate(ticketData.created_at)}}</td>
                        </tr>
                        <tr>
                            <td>Updated At</td>
                            <td>{{convertDate(ticketData.updated_at)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="row" v-if="ticketData.status == 0">
                    <div class="col-md-6">
                        <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
        
                    <div v-if="serverError" class="alert" :class="'alert-' + alertColor" role="alert">
                        {{ serverMessage }}
                    </div>

                    <div class="form-group">
                        <label for="message">Reason For Re-Open Ticket</label>
                        <textarea class="form-control message" id="message" name="message" placeholder="Enter Reason For Re-Open Ticket" v-model.trim="message" rows="8"/>
                        </div>
                        <p
                            v-if="v$.message.$dirty && v$.message.required.$invalid"
                            class="text-danger error-message"
                        >
                            {{ v$.message.required.$message }}
                        </p>
                        <p
                            v-else-if="v$.message.$error && v$.message.minLength"
                            class="text-danger error-message"
                        >
                            {{ v$.message.minLength.$message }}
                        </p>
                        <button type="submit" name="change" id="change" class="btn btn-success">Send</button>
                        &nbsp;
                        <button type="reset" class="btn btn-danger">Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </SectionHeader>    
</template>

<script>
import {getDateTime} from '@/Utils/index.js';
import {mapState} from 'vuex'
import {api} from '@/store/api';
import useVuelidate from "@vuelidate/core";
import {required,helpers,minLength,} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "Reopen",
    data() {
        return {
            ticketData: '',
            categoryName: '',
            message:'',
            userName: '',
            userPhone: '',
        };
    },
    async mounted() {
      await  this.refreshCommentList()
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
                    reopen :  state.permission?.customer_support?.includes('reopen')  ? true : false,
                }
            }
        }),

    },
    validations() {
        return {
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
    methods: {
        convertDate(dt){
            return getDateTime(dt);
        },
        checkPermission() {
            return this.pagePermission.reopen;
        },

        async refreshCommentList(){
             let id = this.$route.params.id;
            await api.get('admin/ticket/' + id).then((data) => data).then(data => {
                let responseData = data.data.data;
                this.ticketData = responseData;
                this.categoryName = responseData.category.name;
                this.userName = responseData.user.name;
                this.userPhone = responseData.user.phone_number;
            }).catch(error => {
                console.log(error);
            })
        },
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate();
            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    ticket_id : this.$route.params.id,
                    comment : 'Ticket Re-Open. Message : '+this.message,
                };

                api.post('admin/ticket/updateStatus/'+userObject.ticket_id,{status:1});
                api.post('admin/ticket/comment', userObject).then(() => {
                    this.$nextTick(() => {
                        this.v$.$reset()
                    })
                    this.show('Ticket Reopen and Message sent Successfully','success', 3000);
                }).catch((err) => {
                         this.show('Ticket do not Reopen','error',3000); 
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
