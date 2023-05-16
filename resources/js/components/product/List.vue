<template>
    <div class="container">
        <div class="row">
          <div class="display-header d-flex justify-content-between pb-3">
            <h2 class="display-7 text-dark text-uppercase">Products - Groceries</h2>
          </div>
          <div class="swiper product-watch-swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="(product,key) in products" :key="key">
                <div class="product-card position-relative">
                  <div class="image-holder">
                    <img :src="product.images[0].src" alt="{{product.name}}" class="img-fluid" style="height: 270px; width: 270px;">
                  </div>
                  <addToCart :productID="product.id" :productName="product.name"/>
                  <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                    <h3 class="card-title text-uppercase">
                      <a href="#">{{product.name}}</a>
                    </h3>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination position-absolute text-center"></div>
</template>

<script>
import addToCart from './AddToCart.vue'
export default {
    name: "endpointProducts",
    data(){
        return{
            products: []
        }
    },
    mounted(){
        this.getProducts()
    },
    components: {
        addToCart
    },
    methods:{
        async getProducts(){
            await axios.get('https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products', {
                headers: {
                    'Access-Control-Allow-Methods': 'GET, POST',
                    'Access-Control-Allow-Headers': 'Content-Type, Authorization'
                }
            }).then(response=>{
                this.products = response.data
            }).catch(error=>{
                console.log(error)
                this.products = []
            })
        },
        async addToCart(id) {
            await axios.post('/api/cart', {
                'product_id': id
            }).then(response=>{
            }).catch(error=>{
                console.log(error);
            });
        }
    }
}
</script>