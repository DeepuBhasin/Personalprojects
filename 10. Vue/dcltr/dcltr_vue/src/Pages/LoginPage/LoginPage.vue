<template>
<div class="login-page" style="min-height: 466px;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>D'cluttr</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
                    <div class="input-group mb-3">
                        <IText type="text" name="email" placeholder="Enter Your Email ID" v-model="email" classes="form-control"></IText>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    <p v-if="v$.email.$dirty && v$.email.required.$invalid" class="text-danger error-message">{{v$.email.required.$message}}</p>
                    <p v-if="v$.email.$dirty && v$.email.email.$invalid" class="text-danger error-message">{{v$.email.email.$message}}</p>

                    <div class="input-group mb-3">
                        <IText type="password" name="email" placeholder="Enter Your Password" v-model="password" classes="form-control">
                        </IText>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p v-if="v$.password.$dirty && v$.password.required.$invalid" class="text-danger error-message">{{v$.password.required.$message}}</p>

                    <div class="row">
                        <div class="col-12"><button type="submit" class="btn btn-primary btn-block">Login</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapState,
    mapActions
} from 'vuex'
import IF from '../../components/IF';
import IText from '../../components/IText'
import useVuelidate from '@vuelidate/core';
import {
    email,
    required,
    helpers
} from '@vuelidate/validators'
import lodash from 'lodash'
export default {
    name: 'LoginPage',
    components: {
        IF,
        IText,

    },
    data() {
        return {
            title: "Admin",
            email: "",
            password: "",
        }
    },
    setup() {
        return {
            v$: useVuelidate()
        }
    },
    validations() {
        return {
            email: {
                required: helpers.withMessage('Email field cannot be empty', required),
                email: helpers.withMessage('Email is not valid', email),
            },
            password: {
                required: helpers.withMessage('Password field cannot be empty', required)
            }
        }
    },
    created() {
        let token = localStorage.getItem('token');
        if (token) {
            this.$router.push({
                name: 'Dashboard'
            });
        }
    },
    computed: {
        ...mapState('users', {
            firstname: (state) => state,
        }),

        updatedName() {
            return this.title + "-Boss";
        }
    },
    inject: ['show', 'hide'],
    methods: {
        ...mapActions('users', ['loginUser']),
        onSubmit: lodash.debounce(function (e) {
            this.v$.$validate()

            if (this.v$.$error) {
                return false;
            } else {
                let userObject = {
                    email: this.email,
                    password: this.password
                }
                this.loginUser(userObject).then(() => {
                    this.$router.replace('Dashboard');
                }).catch((err) => {
                    this.show('Invalid Email/Password', 'error',3000)
                })
             }
        }, 300)
    },

}
</script>

<style scoped>
.register button {
    width: 320px;
    height: 40px;
    border: 1px solid skyblue;
    color: #fff;
    background-color: skyblue;
    cursor: pointer;
}

#app {
    margin: 0px;
}
</style><style>
#app {
    margin: 0px;
}
</style>
