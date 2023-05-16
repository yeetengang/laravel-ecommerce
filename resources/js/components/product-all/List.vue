<template>
    <div class="container mx-auto px-4">
        <div class="flex mb-4">
            <div class="row" v-if="productsLocal.length > 0">
                <div class="col-4 mb-4" v-for="(product,key) in productsLocal" :key="key">
                    <div class="card border-1 h-100">
                        <div class="card-body p-3">
                            <h4 class="title text-left card-title ">{{product.name}}</h4>
                            <p class="description text-left card-text" v-html="product.description"></p>
                            <p class="card-subtitle price">RM {{product.regular_price}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "products-local",
    data(){
        return{
            productsLocal: []
        }
    },
    mounted(){
        this.getProductsLocal()
    },
    methods:{
        async getProductsLocal(){
            await axios.get('/api/local').then(response=>{
                this.productsLocal = response.data
            }).catch(error=>{
                console.log(error)
                this.productsLocal = []
            })
        },
    }
}
</script>