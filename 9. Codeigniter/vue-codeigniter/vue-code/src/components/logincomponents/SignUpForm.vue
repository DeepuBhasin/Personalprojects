<template>
<h2>Sign Up</h2>
<alert-message :color="color" :message="message" v-if="alertStatus"></alert-message>
<form @submit.prevent="addUser" autocomplete="off">
    <br />
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" class="form-control" id="firstName" aria-describedby="firstName" placeholder="Enter First Name" v-model="firstName" /><br />
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="lastName" placeholder="Enter Last Name" v-model="lastName" /><br />
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="email" /><br />
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" v-model="password" />
        <br />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    &nbsp;
    <button type="reset" class="btn btn-danger">Clear</button>
</form>
</template>

  
<script>
import {
    postRequest
} from '@/api/api-functions'
export default {
    name: 'SignUpForm',
    data() {
        return {
            firstName: "",
            lastName: "",
            email: "",
            password: "",
            alertStatus: false,
            color : "",
            message : ""
        }
    },
    methods: {
        async addUser() {
            let userData = {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                password: this.password,
            };
            let responseData = await postRequest('add_user', userData);
            if(responseData.data.error === false){
              this.firstName = "";
              this.lastName = "";
              this.email = "";
              this.password = "";
              this.color = 'success';
              this.message = responseData.data.data
            } else {
              this.color = 'danger';
              this.message = responseData.data.data
            }

            this.alertStatus = true;

            setTimeout(()=> {
              this.alertStatus = false
            },3000);
        }
    }
}
</script>
