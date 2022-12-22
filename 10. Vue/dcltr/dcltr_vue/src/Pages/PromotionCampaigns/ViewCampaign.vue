<template>
<SectionHeader header="View Promotion Campaigns" :titleBoolen="true">
    <template v-slot:breadCrumbsLinks>
        <li class="breadcrumb-item active">
                <router-link to="/promotioncampaigns">Promotion Campaigns</router-link>
        </li>
        <li class="breadcrumb-item">
            View Promotion Campaigns
        </li>
    </template>
    <template v-slot:title>
            <h3 class="card-title">View Promotion Campaigns</h3>
        </template>
    <template v-slot:body>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Information</th><th>Values</th>
                    </tr>
                    <tr>
                        <td>Title of Promotional Campaign</td><td>{{title}}</td>
                    </tr>
                    <tr>    
                        <td>Type</td><td>{{type}}</td>
                    </tr>
                    <tr>    
                        <td>Description</td><td>{{description}}</td>
                    </tr>
                    <tr>   
                        <td>Max Limit</td><td>{{max_limit}}</td>
                    </tr>
                    <tr>   
                        <td>Name of organization/company</td><td>{{name_of_organization_company}}</td>
                    </tr>
                     <tr>   
                        <td>Address of organization/company</td><td>{{address_of_organization_company}}</td>
                    </tr>
                     <tr>   
                        <td>Email of organization</td><td>{{email}}</td>
                    </tr>
                     <tr>   
                        <td>Promotional Image</td><td><img style="width:50%; height:50%" class="img-thumbnail" :src="'http://dcltr.oidea.xyz/storage/'+image" /></td>
                    </tr>
                     <tr>   
                        <td>Set Image as Background</td><td>{{set_image_as_background}}</td>
                    </tr>
                    <tr>   
                        <td>From Date</td><td>{{from_date}}</td>
                    </tr>
                    <tr>   
                        <td>To Date</td><td>{{to_date}}</td>
                    </tr>
                    <tr>   
                        <td>Open in Cities</td>
                        <td>
                            <ol>
                                <li v-for="item in cities" :key="item.id">{{item.city_name.name}}</li>
                            </ol>
                        </td>
                    </tr>
                     <tr>   
                        <td>Need Inspection</td><td>{{select_need_inspection}}</td>
                    </tr>
                    <tr>   
                        <td>Status</td><td>{{select_status}}</td>
                    </tr>
                     <tr>   
                        <td>Created At</td><td>{{convertDate(created_at)}}</td>
                    </tr>
                    <tr>   
                        <td>Updated At</td><td>{{convertDate(updated_at)}}</td>
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
            paramId : 0,
            title: '',
            select_type: '',
            description : '',
            max_limit : '',
            cities : '',
            name_of_organization_company : '',
            address_of_organization_company : '',
            email_of_organization : '',
            set_image_as_background : '',
            image : '',
            from_date : '',
            to_date : '',
            showCityNameArray : [],
            select_need_inspection : '',
            select_status : '',
            promotional_image : null,
            created_at : '',
            updated_at : ''
        };
    },
    methods:{
        convertDate(dt){
            return getDateTime(dt);
        },
    },
    async mounted(){
        this.paramId = this.$route.params.id;
        let responseData = await getRequest(`admin/campaign/${this.paramId}`);
        this.title = responseData.title;
        this.type = responseData.type ? 'Donation' : 'Recycle';
        this.description = responseData.description;
        this.max_limit = responseData.donation_limit;
        this.name_of_organization_company = responseData.company_name;
        this.address_of_organization_company = responseData.company_address;
        this.email = responseData.email;
        this.cities = responseData.cities;
        this.image = responseData.image;
        this.set_image_as_background = responseData.set_background_image ? 'Yes' : 'No';
        this.from_date = responseData.start_date;
        this.to_date = responseData.end_date;
        this.select_need_inspection = responseData.need_inspection ? 'Yes' : 'No';
        this.select_status = responseData.is_active ? 'Active' : 'Inactive';
        this.created_at = responseData.created_at;
        this.updated_at = responseData.updated_at;
    }   
};
</script>
