<template>
    <div class="container-fluid d-flex justify-content-center mb-3" v-for="(orderItem,key) in orders" :key="key">
        <div class="card card-1" :id="orderItem.id" style="width: 60%;">
            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color">Receipt</h6> </div>
                </div>
                <div class="row mx-auto" v-for="(eachOrderItem, key) in orderItem.name_array" :key="key">
                    <div class="row mx-auto" >
                        <div class="card card-2">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body my-auto text-right">
                                        <div class="row  my-auto flex-column flex-md-row">
                                            <div class="col-8"> <h6 class="mb-0">{{eachOrderItem}}</h6></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="row justify-content-between">
                            <div class="col-auto"><p class="mb-1 text-dark"><b>Order Details</b></p></div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col"><p class="mb-1"><b>Delivery Charges</b></p></div>
                            <div class="flex-sm-col col-auto"><p class="mb-1">Free</p></div>
                        </div>
                    </div>
                </div>
                <div class="row invoice">
                    <div class="col"><p class="mb-1">Invoice Date : {{orderItem.date}}</p></div>
                </div>
                <div class="row p-3" v-if="orderItem.status != 'Cancelled'">
                    <button type="button" v-on:click.prevent="cancelOrder(orderItem.id)" class="btn btn-danger">Cancel This Order</button>
                </div>
                <div class="row p-3" v-if="orderItem.status == 'Cancelled'">
                    <div class="text-center">Order has been cancelled</div>
                </div>
                <div class="row p-3" v-if="orderItem.status == 'Delivered'">
                    <div class="text-center">Order has been delivered</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Order",
    data(){
        return {
            orders: []
        }
    },
    methods: {
        async getOrderDetails() {
            await axios.get('/order/get/orders')
            .then(response=>{
                this.orders = response.data;
                console.log(response);
                this.orders.forEach((item, i)=>{
                    console.log(this.orders.created_at);
                    const date = new Date(item.created_at);
                    this.orders[i].date = date.toLocaleString();

                    var itemList = item.id_list.split('#');
                    itemList.pop();
                    this.orders[i].id_array = itemList;

                    var productNameList = item.product_name.split('#');
                    productNameList.pop();
                    this.orders[i].name_array = productNameList;
                });
            }).catch(error=>{
                this.orders = [];
                console.log(error);
            });
        },
        cancelOrder(id) {
            if (confirm("Are you sure to cancel this order?")) {
                axios.put('/order/update/'+id, {
                    'status': 'Cancelled',
                    'id': id
                }).then(response=>{
                    this.getOrderDetails();
                    setTimeout(() => {
                        window.location.reload;
                    }, 500);
                }).catch(error=>{
                    console.log(error);
                });
            }
        }
    },
    mounted() {
        this.getOrderDetails();
    }
}
</script>