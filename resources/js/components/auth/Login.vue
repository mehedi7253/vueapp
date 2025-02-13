<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>User Login Form</h4>

                    </div>
                    <div class="card-body">
                        <ul v-for="error in errors">
                            <li class="text-danger">{{ error }}</li>
                        </ul>
                        <form @submit.prevent="login">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" v-model="user.email" placeholder="Enter Email">
                                <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" v-model="user.password" placeholder="Enter Email">
                                <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <button @click="loginWithGoogle">Login with Google</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p v-if="users">Welcome, {{ users.name }}</p>
                        <router-link to="/register">Registration</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default{
    data() {
        return {
            user:{
                email: '',
                password: ''
            },
            errors: '',
            users: '',
            token: '',
        }
    },
    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');

        if (token) {
            localStorage.setItem('token', token);
            this.token = token;
            this.getUserData();
        }
    },
    methods: {
        login() {
            this.clearMessage();
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/login', this.user)
                    .then(response => {
                        if (response.status == 201) {
                            const status = true;
                            const token = response.data.token;

                            this.$store.dispatch('setAuthToken', token)
                            this.$store.dispatch('setAuthStatus', status)
                            this.$router.push('/dashboard');
                            toast("Profile Update Success!", {
                                "theme": "auto",
                                "type": "success",
                                "transition": "bounce",
                                "dangerouslyHTMLString": true
                            });

                        }

                    }).catch(error => {
                        if (error.response.status == 422) {
                            this.errors = Object.values(error.response.data.errors).flat()
                        }else {
                            this.errors = ['Something went wrong']
                        }
                    });
            })
        },

        loginWithGoogle() {
            window.location.href = 'api/auth/google';
        },
        async getUserData() {
        try {
            const response = await axios.get('api/user', {
                headers: { Authorization: `Bearer ${this.token}` },
                });
                this.users = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        clearMessage() {
            this.errors = '';
        }
    }
}
</script>
