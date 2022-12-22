<template>
    <SectionHeader header="Customer Support" :titleBoolen="true">
        <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                    <router-link to="/customersupport">Customer Support</router-link>
            </li>
            <li class="breadcrumb-item">
                View Ticket
            </li>
        </template>    
        <template v-slot:title>
            <h4 class="card-title" style="float: none;">{{categoryName}}</h4>
            <p style="display: block;color: #dc3545;margin-bottom: 0px;">{{ticketData.title}}</p>
        </template>   
        <template v-slot:body>
            <div class="row">
                <div class="col-md-12">
                    <div class="ticketInfoMain">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <span>Ticket Id</span>#{{ticketData.id}}
                            </div>

                            <div class="col-md-3 col-6">
                                <span>Status</span>{{ticketData.status == 0 ? 'Closed' : ticketData.status == 1 ? 'Open' : 'Re-Open'}}
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <span>Date</span>{{convertDate(ticketData.created_at)}}
                            </div>
                            <div class="col-md-3 col-6">
                                <span>Priority</span>{{ticketData.priority == 0 ? 'Low' : ticketData.priority == 1 ? 'Medium' : 'High'}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ticket-message">
                <div class="ticket-content">
                    <div class="comment-name"><a href="">{{userName}}</a> ({{userPhone}})</div>
                    <div class="comment-date" style="margin-top: -6px;">
                        {{convertDate(ticketData.created_at)}}
                    </div>
                    <div class="comment-text">{{ticketData.message}}</div>

                </div>
            </div>
            <div class="ticket-message ticketMessageReply" v-for="item in comments" :key="item.id">
                <div class="ticket-content">
                    <div class="ticketRlyHead">
                        <div class="comment-name" style="top:0px;">
                            {{ item.admin_id ? 'Admin : ( Name : ' + item.admin.name +', Email id : '+item.admin.email +' )': ', User : ( Name :' + item.user.name +', Email id : '+item.user.email +', Phone : '+ item.user.phone_number+' )'}} 
                            &nbsp;&nbsp;<i class="fa-solid fa-arrow-right" style="color: #0056b3;font-size: 20px;position: relative;top: 3px;"></i>&nbsp;&nbsp;  User Name
                        </div>
                        <div class="comment-date">
                            {{convertDate(ticketData.created_at)}}
                        </div>
                    </div>
                    
                    
                    <div class="comment-text">{{item.comment}}</div>

                </div>
            </div>
                
            <div class="row" v-if="ticketData.status == 1 || ticketData.status == 2">
                <div class="col-md-12">
                    <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
                        <div class="form-group">
                            <!-- <label for="message">Message</label> -->
                            <textarea class="form-control message" id="message" name="message" placeholder="Enter Message" v-model.trim="message" rows="5" />
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
                        <button type="submit" name="change" id="change" class="btn btn-primary">Send</button>&nbsp;
                        <button type="reset" class="btn btn-danger">Clear</button>
                    </form>    
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
import {required,helpers,minLength} from "@vuelidate/validators";
import lodash from "lodash";
export default {
    name: "ViewSpecificTicket",
    data() {
        return {
            ticketData: '',
            categoryName: '',
            message:'',
            userName: '',
            userPhone: '',
            comments: []

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
                    view: state.permission?.customer_support?.includes('view') ? true : false,
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
            return this.pagePermission.view;
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
            await api.get('admin/ticket/comment?ticket_id=' + id).then((data) => data).then(data => {
                let responseData = data.data.data;
                this.comments = responseData;
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
                    comment : this.message,
                };

                api.post('admin/ticket/comment', userObject).then(() => {
                    this.refreshCommentList();
                    this.$nextTick(() => {
                        this.v$.$reset()
                    })
                        this.message = "";
                        this.show('Message Send Successfully','success', 3000)
                    }).catch((err) => {
                        this.show('Message do not Sent','error', 3000)
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
