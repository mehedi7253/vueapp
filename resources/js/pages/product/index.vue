<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                       All Product
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in products" :key="product.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <img :src="product.thumbnail" class="img-thumbnail" style="height: 50px; width: 50px;">
                                    </td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.price }}</td>
                                    <td>
                                        <span v-if="product.status == '0'">
                                            <badge class="badge badge-success">active</badge>
                                        </span>
                                        <span v-else>
                                            <badge class="badge badge-danger">inactive</badge>
                                        </span>
                                    </td>
                                    <td>
                                        <router-link class="btn btn-primary btn-sm" :to="{name: 'EditProduct', params:{ productId: product.id}}">Edit</router-link>
                                        <button class="btn btn-danger btn-sm ml-2" @click="deleteProduct(product.id)">Delete</button>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import DataTable from 'datatables.net-dt';
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';

    export default{
        data(){
            return {
                products: [],
            }
        },
        mounted(){
            this.fetchProducts();
        },
        methods:{
            fetchProducts(){
                axios.get('api/products')
                .then(response => {
                    this.products = response.data;
                    this.$nextTick(() => {
                        this.initDataTable();
                    });
                }).catch(error => {
                    console.log(error);
                });
            },
            initDataTable() {
                let table = new DataTable('#myTable');
            },
            deleteProduct(productId){
                axios.delete(`api/products/${productId}`)
               .then(response => {
                    this.$nextTick(() => {
                        this.fetchProducts();
                        this.initDataTable();
                    });
                    toast("Product Delete Successful", {
                        "theme": "auto",
                        "type": "success",
                        "transition": "bounce",
                        "dangerouslyHTMLString": true
                    });
                }).catch(error => {
                    console.log(error);
                });
            }
        },
    }
</script>
