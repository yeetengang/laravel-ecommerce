<template>
    <div class="user-items ps-5">
        <ul class="d-flex justify-content-end list-unstyled">
            <li>
                <a href="/checkout" >
                    <svg class="cart">
                    <use xlink:href="#cart"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Cart",
    data() {
        return {
            itemCount: '',
        }
    }, 
    methods() {

    },
    created() {
        //this.getCartItemsOnPageLoad();
    }
}
</script>