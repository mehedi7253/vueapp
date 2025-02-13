<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>All Product</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.product_name }}</td>
                                    <td>
                                        <span v-if="!product.discount_price">
                                            {{ product.price }}
                                        </span>
                                        <span v-else>
                                            {{ product.discount_price }}
                                            <del class="text-danger">{{ product.price }}</del>
                                        </span>
                                    </td>
                                    <td>
                                        <button @click="addToCart(product.id)" class="btn btn-info btn-sm">Add to Cart</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Cart Item</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="cartItems.length > 0">
                                <tr v-for="item in cartItems" :key="item.id">
                                    <td>
                                        <!-- <img :src="item.options.image" class="img-fluid" alt="Product Image"> -->
                                    </td>
                                    <td>{{ item.price }}</td>
                                    <td>
                                        <input type="number" v-model="item.qty" min="1" max="10">
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot v-else>
                                <tr>
                                    <td colspan="4" class="text-center">No items in cart.</td>
                                </tr>
                            </tfoot>
                        </table>
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
                products: [],
                cartItems: [],
            }
        },
        mounted(){
            this.getProducts();
            this.fetchCartData();
        },
        methods:{
            getProducts(){
                axios.get('api/products')
                   .then(response => {
                        this.products = response.data;
                    })
                   .catch(error => {
                        console.error(error);
                    });
            },
            addToCart(productId){
                axios.post('api/add-to-cart', { product_id: productId})
                .then(response => {
                    // this.cartItems = response.data;
                    this.fetchCartData();
                })
               .catch(error => {
                    console.error('Error adding product to cart:', error);
                });
            },
            async fetchCartData(){
                try{
                    const response = await axios.get('/api/cart-item');
                    this.cartItems = response.data;
                    this.totalPrice = response.data.totalPrice;
                }catch(error){
                    console.error('Error fetching cart data:', error);
                }
            },
        },
    }
</script>
