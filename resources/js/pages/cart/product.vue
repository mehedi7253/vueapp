<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>All Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>
                                       <img :src="product.thumbnail" style="height: 50px; width: 50px;">
                                    </td>
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
                        <h3>Cart Items</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td colspan="5" v-if="cartItems.length == 0">No items in the cart</td>
                                </tr>
                                <tr v-for="item in cartItems" :key="item.id">
                                    <td><img :src="item.options.image"></td>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        <button @click="updateCart(item.rowId)" class="btn btn-info btn-sm">+</button>
                                        <input type="text" class="form-control" v-model="item.qty" style="width: 50px;">
                                        <button @click="minusFromCart(item.rowId)" class="btn btn-danger btn-sm">-</button>
                                    </td>
                                    <td>{{ item.price * item.qty }}</td>
                                    <td>
                                        <button @click="removeFromCart(item.rowId)" class="btn btn-danger btn-sm">x</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total</td>
                                    <td>{{ totalPrice }}</td>
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
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    export default {
        data() {
            return {
                products: [],
                cartItems: [],
                totalPrice: 0
            }
        },
        mounted() {
            this.getProducts();
            this.fetchCartData();
        },
        methods: {
            getProducts() {
                axios.get('/api/products')
                    .then(response => {
                        this.products = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            fetchCartData() {
                axios.get('/api/cart-item')
                    .then(response => {
                        this.cartItems = response.data.cartItems;
                        this.totalPrice = response.data.totalPrice;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            addToCart(productId) {
                axios.post('/api/add-to-cart', { product_id: productId })
                    .then(response => {
                        this.fetchCartData();
                        toast("New Item Add to Cart!", {
                            "theme": "auto",
                            "type": "success",
                            "transition": "bounce",
                            "dangerouslyHTMLString": true
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            removeFromCart(rowId) {
                axios.post('/api/remove-cart', { rowId: rowId })
                    .then(response => {
                        this.fetchCartData();
                        toast("Item Removed Successful", {
                            "theme": "auto",
                            "type": "success",
                            "transition": "bounce",
                            "dangerouslyHTMLString": true
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            minusFromCart(rowId){
                axios.post('/api/decrement-quantity', { rowId: rowId })
                    .then(response => {
                        this.fetchCartData();
                    }).catch(error => {
                        console.error(error);
                    });
            },
            updateCart(rowId){
                axios.post('/api/update-cart', { rowId: rowId })
                    .then(response => {
                        this.fetchCartData();
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
</script>
