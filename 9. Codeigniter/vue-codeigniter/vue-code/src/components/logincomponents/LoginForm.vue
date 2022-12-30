<template>
  <h2>Login</h2>
  <form @submit.prevent="loginUser">
    <alert-message :color="color" :message="message" v-if="alertStatus"></alert-message>
    <br/>
    <div class="form-group">
      <label for="email">Email address</label>
      <input
        type="email"
        name="email"
        class="form-control"
        id="email"
        aria-describedby="emailHelp"
        placeholder="Enter email"
        v-model="email"
      /><br />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input
        type="password"
        name="password"
        class="form-control"
        id="password"
        placeholder="Password"
        v-model="password"
      />
      <br />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    &nbsp;
    <button type="reset" class="btn btn-danger">Clear</button>
  </form>
</template>
<script>
 import {postRequest, saveTokenToStorage} from '@/api/api-functions.js';
export default {
    name : 'LoginForm',
    data() {
      return {
        email : "",
        password : "",
        color : '',
        message : '',
        alertStatus : false
      }
    },
    methods:  {
      async loginUser() {
        let userData = {
          email : this.email,
          password : this.password
        };

        let responseData = await postRequest('login_user', userData);
        if(responseData.data.error === true) {
          this.alertStatus = true;
          this.color = 'danger';
          this.message = responseData.data.data
          
          setTimeout(()=> {
                this.alertStatus = false
          },3000);
        } else {
          alert('Login successfully');
          saveTokenToStorage(responseData.data.data);
          this.$router.replace({name : 'dashboard'});
        }

      }
    }
}
</script>
