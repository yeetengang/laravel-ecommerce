<template>
    <div class="cart-concern position-absolute">
        <div class="cart-button d-flex">
            <a href="#" class="btn btn-medium btn-black" v-on:click.prevent="addProductToCart()">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "addToCart",
    data() {
        return {
            
        }
    }, 
    props: {
        productID: {
            type: Number,
            required: true
        },
        productName: {
            type: String,
            required: true,
        }
    },
    methods: {
        async addProductToCart() {
            this.$toast.show("Adding item to cart...");
            await axios.post('/cart', {
                'product_id': this.productID,
                'product_name': this.productName
            }).then(response=>{
                this.$toast.show(response.data['message']);
                //this.$emit('changeInCart', response.data['item']);
            }).catch(error=>{
                console.log(error)
            });
        }
    },
    mounted(){
        
    },
}
</script>