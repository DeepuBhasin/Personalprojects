<template>
    <h2>My Profile</h2>
    <div class="my-3" v-if="loading">
        <div class="form-group">
            <label for="">Firstname</label>
            <div class="form-control">{{firstName}}</div>
            <br/>
        </div>
        <div class="form-group">
            <label for="">Lastname</label>
            <div class="form-control">{{lastName}}</div>
            <br/>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <div class="form-control">{{email}}</div>
            <br/>
        </div>
        <div class="form-group">
            <router-link :to="{name : 'searchuser'}" class="btn btn-info">Back</router-link>
        </div>
    </div>
    <div v-else>
        <h2>loading.......</h2>
    </div>
    
</template>
<script>
import { getRequest } from '@/api/api-functions'
export default {
    name : 'ViewUserComponent',
    data() {
        return {
            firstName : '',
            lastName : '',
            email : '',
            id : '',
            loading : false
        }
    },
    methods: {
        async myProfileDetails() {
            this.id = this.$route.params.id;
            let responseData = await getRequest(`my_profile/${this.id}`);
            let userData = responseData.data;

            this.loading = true;


            this.firstName = userData.first_name;
            this.lastName = userData.last_name;
            this.email = userData.email;
        },
        
    },
    async mounted() {
        await this.myProfileDetails();
    }
}
</script>