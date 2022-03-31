<template>
    <div class="row">
        <div v-for="product in products" class="col-md-6" :key="product.id">
            <div class="card mb-2">
                <div class="card-header">
                    <h5>Product: {{ product.attributes.title }}</h5>
                </div>
                <div class="x_panel text-right">
                    <p>Price: {{ product.attributes.price }} $</p>
                    <p>
                        Categories:
                        <span v-for="category, key in product.relations.categories" :key="category.id">
                            <router-link :to="`/category/${category.id}/products`">{{ category.attributes.title }} </router-link>
                            <span v-if="key+1 < product.relations.categories.length">, </span>
                        </span>
                    </p>
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
                products: [],
            }
        },

        mounted() {
            this.getProducts()
        },

        methods: {
            getProducts () {
                axios
                .get('/api/products')
                .then(({data}) => this.products = data)
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
