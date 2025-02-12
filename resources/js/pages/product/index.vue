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
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in products" :key="product.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ product.id }}</td>
                                    <td>
                                        <img :src="product.thumbnail" class="img-thumbnail" style="height: 50px; width: 50px;">
                                    </td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.price }}</td>
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
        },
    }
</script>
