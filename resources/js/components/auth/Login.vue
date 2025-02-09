<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="mt-5 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">login</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="loginForm">
                                <div class="form-group col-12">
                                    <label>Email <sup>*</sup></label>
                                    <input type="email" v-bind:class="errors && errors.email ? 'form-control is-invalid' : 'form-control'" v-model="user.email" placeholder="Enter Your Email">
                                    <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>Password <sup>*</sup></label>
                                    <input type="password" v-bind:class="errors && errors.password ? 'form-control is-invalid' : 'form-control'" v-model="user.password" placeholder="Enter Your Password">
                                    <span v-if="errors.email" class="text-danger">{{ errors.password }}</span>
                                </div>

                                <div class="form-group col-12">
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default{
        data(){
            return{
                user: {
                    email: '',
                    password: '',
                },
                errors: {},
            }
        },
        methods: {
            loginForm(){
                axios.post('api/login', this.user)
                .then(response => {
                    this.errors = '';
                    //clear all input fields
                    this.user = {
                        email: '',
                        password: '',
                    },
                    toast("User Login Success!", {
                        "theme": "auto",
                        "type": "success",
                        "transition": "bounce",
                        "dangerouslyHTMLString": true
                    });
                    store.dispatch('khayrul', response.data.token)
                    this.$router.push({name: 'dashboard'})
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        },

    }
</script>
