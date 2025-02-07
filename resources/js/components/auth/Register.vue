<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="mt-5 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Registration</h3>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="RegistrationForm">
                                <div class="form-group col-12">
                                    <label>Name <sup>*</sup></label>
                                    <input type="text" v-bind:class="errors && errors.name ? 'form-control is-invalid' : 'form-control'" v-model="reg.name" placeholder="Enter Your Name">
                                    <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>Email <sup>*</sup></label>
                                    <input type="email" v-bind:class="errors && errors.email ? 'form-control is-invalid' : 'form-control'" v-model="reg.email" placeholder="Enter Your Email">
                                    <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>Password <sup>*</sup></label>
                                    <input type="password" v-bind:class="errors && errors.password ? 'form-control is-invalid' : 'form-control'" v-model="reg.password" placeholder="Enter Your Password">
                                    <span v-if="errors.email" class="text-danger">{{ errors.password }}</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>Confirm Password <sup>*</sup></label>
                                    <input type="password" v-bind:class="errors && errors.password_confirmation ? 'form-control is-invalid' : 'form-control'" v-model="reg.password_confirmation" placeholder="Enter Your Password Again">
                                    <span v-if="errors.password_confirmation" class="text-danger">{{ errors.password_confirmation }}</span>
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
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    export default{
        data(){
            return {
                reg: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: [],
            }
        },
        methods:{
            RegistrationForm(){
                axios.post('api/register', this.reg)
                .then(response => {
                    this.errors = '';
                    //clear all input fields
                    this.reg = {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation: ''
                    },
                    toast("New User Registration Success!", {
                        "theme": "auto",
                        "type": "success",
                        "transition": "bounce",
                        "dangerouslyHTMLString": true
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }


</script>
