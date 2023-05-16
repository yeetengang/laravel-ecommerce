<template>
    <div class="container">
      <div class="py-5 text-center">
        <h2>Checkout form</h2>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed" v-for="(item,key) in cartItems" :key="key">
              <div>
                <h6 class="my-0">{{item.product_name}}</h6>
              </div>
            </li>
          </ul>
          <div v-if="cartItems.length === 0">
            <h6 class="my-0">No item in cart</h6>
          </div>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" v-model="firstName" placeholder="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" v-model="lastName" placeholder="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" v-model="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" v-model="address" placeholder="Address Line 1" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" v-model="address2" placeholder="Address Line 2">
            </div>

            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" v-model="zipcode" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" v-if="cartItems.length != 0" v-on:click.prevent="submit()">Place Order</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; Copyright 2023 Ecommerce Website</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Checkout",
    data() {
        return{
            cartItems: [],
            ids: '',
            firstName: '',
            lastName: '',
            address: '',
            address2: '',
            email: '',
            zipcode: '',
            product_name: ''
        }
    }, 
    methods: {
        async getCartItems() {
            await axios.get('/checkout/get/items')
            .then(response=>{
                console.log(response);
                this.cartItems = response.data['item'];
                this.ids = response.data['ids'];
                this.product_name = response.data['productNames'];
            }).catch(error=>{
                console.log(error);
            });
        },
        async submit() {
            if (this.firstName!='' && this.lastName != '' && this.address != '' && this.email != '' && this.zipcode != '') {
                
                await axios.post('/order/submit', {
                    'id_list': this.ids,
                    'status': 'Submitted', // Submitted, Delivered, Cancelled Status
                    'firstName': this.firstName,
                    'lastName': this.lastName,
                    'address': this.address,
                    'address2': this.address2,
                    'email': this.email,
                    'zipcode': this.zipcode,
                    'product_name': this.product_name
                }).then(response=>{
                    console.log(response);
                    //this.$toast.show(response.data['message']);
                    setTimeout(() => {
                        window.location.href='/';
                    }, 500);
                }).catch(error=>{
                    console.log(error)
                });
            } else {
                alert('Some fields are empty!');
            }
        }
    },
    mounted() {
        this.getCartItems();
    }
}
</script>