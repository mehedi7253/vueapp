<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        Add New Product
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addNewProduct" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="productName">Product Name:</label>
                                    <input type="text" v-bind:class="errors && errors.product_name ? 'form-control is-invalid' : 'form-control'" v-model="product.product_name" id="productName" placeholder="Enter Product Name">
                                    <span v-if="errors.product_name" class="text-danger">{{ errors.product_name }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="productPrice">Product Price:</label>
                                    <input type="number" v-bind:class="errors && errors.price ? 'form-control is-invalid' : 'form-control'" v-model="product.price" placeholder="Enter Price">
                                    <span v-if="errors.price" class="text-danger">{{ errors.price }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="productPrice">Discount Price:</label>
                                    <input type="number" v-bind:class="errors && errors.discount_price ? 'form-control is-invalid' : 'form-control'" v-model="product.discount_price" placeholder="Enter Price">
                                    <span v-if="errors.discount_price" class="text-danger">{{ errors.discount_price }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="productPrice">Thumbnail:</label>
                                    <input type="file" v-bind:class="errors && errors.thumbnail ? 'form-control is-invalid' : 'form-control'" id="thumbnail" @change="handleFileUpload">
                                    <span v-if="errors.thumbnail" class="text-danger">{{ errors.thumbnail }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="productQuantity">Status:</label>
                                    <select v-bind:class="errors && errors.status ? 'form-control is-invalid' : 'form-control'" id="productQuantity" v-model="product.status">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span v-if="errors.status" class="text-danger">{{ errors.status }}</span>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default{
    data() {
        return {
            product: {
                product_name: '',
                price: '',
                discount_price: '',
                thumbnail: null,
                status: ''
            },
            errors: [],
        }
    },
    methods: {
        handleFileUpload(event) {
            this.product.thumbnail = event.target.files[0];
        },
        addNewProduct(){
            let formData = new FormData();
            formData.append('product_name', this.product.product_name);
            formData.append('price', this.product.price);
            formData.append('discount_price', this.product.discount_price);
            formData.append('thumbnail', this.product.thumbnail);
            formData.append('status', this.product.status);

            try{
                let response = axios.post('api/products', formData,{
                    headers: {
                        'Content-Type':'multipart/form-data'
                    }
                }).then((response) => {
                    toast("New Product Successful", {
                        "theme": "auto",
                        "type": "success",
                        "transition": "bounce",
                        "dangerouslyHTMLString": true
                    });
                    //clear all input fields
                    this.product = {
                        product_name: '',
                        price: '',
                        discount_price: '',
                        thumbnail: null,
                        status: ''
                    };
                    this.errors = '';
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });

            }catch(error) {
                console.log(error);
            }
        }
    }
}

</script>
