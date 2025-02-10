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
                                <input type="email" class="form-control" id="email" v-model="email" placeholder="Enter Email">
                                <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" v-model="password" placeholder="Enter Email">
                                <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <router-link to="/register">Registration</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapActions } from 'vuex';

  export default {
    data() {
      return {
            email: '',
            password: '',
            errors: '',
        };
    },
    methods: {
      ...mapActions('auth', ['login']),
      async login() {
        try {
          await this.login({ email: this.email, password: this.password });
          this.$router.push('/dashboard');
        } catch (error) {
          alert('Login failed');
        }
      },
    },
  };
</script>
