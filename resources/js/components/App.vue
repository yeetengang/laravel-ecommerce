<template>
    <endpointProducts />
</template>
<script>
// ##002: import the component
import endpointProducts from './product/List.vue'
import addToCart from './product/AddToCart.vue'
export default {
    name: 'App',
    components: {
        endpointProducts,
        addToCart
    }
}
</script>