<template>
    <div class="row" v-if="category">
        <h3 class="text-success">Category: ( {{ category.attributes.title }} ) Products</h3>
        <h3> <router-link :to="`/products`"> All Products </router-link> </h3>
        <div v-for="product in category.relations.products" class="col-md-6" :key="product.id">
            <div class="card mb-2">
                <div class="card-header">
                    <h5>Product: {{ product.attributes.title }}</h5>
                </div>
                <div class="x_panel text-right">
                    <p>Price: {{ product.attributes.price }} $</p>
                    <p class="text-right" v-if="!is_admin">
                        <button class="btn btn-primary btn-xs" @click="makeOrder(product.id)">Order</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'is_admin'],

        data () {
            return {
                category: null,
            }
        },

        mounted() {
            this.getProducts()
        },

        methods: {
            getProducts () {
                const categoryId = this.$route.params.id;

                axios
                .get(`/api/category/${categoryId}/products`)
                .then(({data}) => this.category = data)
                .catch(err => alert('error'));
            },

            makeOrder (productId) {
                if(confirm('Make an Order')) {
                    axios
                    .post('/api/orders', {
                        user_id: JSON.parse(this.user).id,
                        product_id: productId
                    })
                    .then(({data}) => alert('Success Order'))
                    .catch(err => alert('error in saving order'));
                }
            },
        }
    }
</script>
