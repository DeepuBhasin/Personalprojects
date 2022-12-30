<template>
    <h2>My Profile</h2>
    <div class="my-3" v-if="loading">
        <form @submit.prevent="UpdateUser">
            <alert-message :color="color" :message="message" v-if="alertStatus"></alert-message>
            <div class="form-group">
                <label for="">Firstname</label>
                <input type="text" name="firstName" placeholder="Enter Firstname" class="form-control" v-model="firstName">
                <br/>
            </div>
            <div class="form-group">
                <label for="">Lastname</label>
                <input type="text" name="lastName" placeholder="Enter Lastname" class="form-control" v-model="lastName">
                <br/>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Enter Email" class="form-control" v-model="email">
                <br/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success"> Update</button>
            </div>
        </form>
    </div>
    <div v-else>
        <h2>loading.......</h2>
    </div>
    
</template>
<script>
import { getRequest, getTokenStorage, postRequest } from '@/api/api-functions'
export default {
    name : 'MyProfileComponent',
    data() {
        return {
            firstName : '',
            lastName : '',
            email : '',
            id : '',
            alertStatus : false, 
            color : '',
            message : '',
            loading : false
        }
    },
    methods: {
        async myProfileDetails() {
            this.id = getTokenStorage();
            let responseData = await getRequest(`my_profile/${this.id}`);
            let userData = responseData.data;

            this.loading = true;


            this.firstName = userData.first_name;
            this.lastName = userData.last_name;
            this.email = userData.email;
        },
        async UpdateUser() {
            let userObject = {
                id : this.id,
                firstName : this.firstName,
                lastName : this.lastName,
                email : this.email,
            }

            let responseData = await postRequest('update_profile', userObject);
            if(responseData.data.error  === false) {
                this.color = 'success';
                this.message = responseData.data.data;
            } else {
                this.color = 'danger';
                this.message = responseData.data.data;
            }

            this.alertStatus = true;

            setTimeout(()=> {
                    this.alertStatus = false
            },3000);

        }
    },
    async mounted() {
        await this.myProfileDetails();
    }
}
</script>