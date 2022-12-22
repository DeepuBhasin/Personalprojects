<template>
<SectionHeader header="View Staff" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
            <router-link to="/staffusers">Staff Users</router-link>
        </li>
        <li class="breadcrumb-item">
            View Staff
        </li>
    </template>
    <template v-slot:title>
            <h3 class="card-title">View Staff</h3>
        </template>
    <template v-slot:body>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr rowspan="2">
                        <th>General Setting</th>
                    </tr>
                    <tr>
                        <td>Name</td><td>{{name}}</td>
                    </tr>
                    <tr>    
                        <td>Email</td><td>{{email}}</td>
                    </tr>
                    <tr>    
                        <td>Phone Number</td><td>{{phone_number}}</td>
                    </tr>
                    <tr>   
                        <td>Profile</td><td>{{rolename}}</td>
                    </tr>
                    <tr>   
                        <td>Created Date</td><td>{{created_date ? convertDate(created_date) : 'N/A'}}</td>
                    </tr>
                    <tr rowspan="2">
                        <th>Bank Details</th>
                    </tr>
                    <tr>   
                        <td>Account Holder Name</td><td>{{account_holder_name ? account_holder_name : 'N/A'}}</td>
                    </tr>
                    <tr>   
                        <td>Bank Name</td><td>{{bank_name ? bank_name : 'N/A'}}</td>
                    </tr>
                    <tr>   
                        <td>Account Number</td><td>{{account_number ? account_number : 'N/A'}}</td>
                    </tr>
                    <tr>   
                        <td>Bank IFSC Code</td><td>{{bank_ifsc_code ? bank_ifsc_code : 'N/A'}}</td>
                    </tr>
                    <tr>   
                        <td>Bank Address</td><td>{{bank_address ? bank_address : 'N/A'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </template>
</SectionHeader>       
</template>
<script>
import {getRequest} from '@/store/api';
import {getDateTime} from '@/Utils/index.js'
export default {
    name: "viewStaff",
    data() {
        return {
            paramId : '',
            name:'',
            email:'',
            phone_number:'',
            rolename:'',
            created_date :'',
            account_holder_name : '',
            bank_name : '',
            account_number : '',
            bank_ifsc_code : '',
            bank_address : '',
        };
    },
    methods:{
        convertDate(dt){
            return getDateTime(dt);
        },
    },
    async mounted(){
        this.paramId = this.$route.params.id;
        let responseData = await getRequest(`admin/userDetail/${this.paramId}`);
        this.name = responseData.name;
        this.email = responseData.email;
        this.phone_number = responseData.phone_number;
        this.rolename = responseData.role.name;
        this.created_date = responseData.created_at;
        let bankResponse = await getRequest(`admin/bankDetail?user_id=${this.paramId}`);
        
        if(bankResponse !== undefined)
        {
            this.account_holder_name = bankResponse.account_holder_name;
            this.bank_name = bankResponse.bank_name;
            this.account_number = bankResponse.account_number;
            this.bank_ifsc_code = bankResponse.ifsc_code;
            this.bank_address = bankResponse.address;
        }
    }
    
};
</script>
