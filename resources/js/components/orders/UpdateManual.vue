<template>
    <form action="" method="POST">
        <label for="order-id">Order ID</label>
        <select name="order-id" id="orderId" v-model="id_selected">
            <option v-for="(id, key) in order_ids" :key="key">{{id}}</option>
        </select>
        <br>
        <label for="status">Order Status</label>
        <select name="status" id="status" v-model="status_selected">
            <option v-for="(statusItem, key) in status_list" :key="key">{{statusItem}}</option>
        </select>
        <br>
        <input type="submit" v-on:click.prevent=" updateOrderStatus()" value="Submit">
    </form>
</template>

<script>
export default {
    name: "UpdateManual",
    data(){
        return {
            order_ids: [],
            status_list: [
                'Cancelled',
                'Submitted',
                'Delivered'
            ],
            id_selected: '',
            status_selected: ''
        }
    },
    methods: {
        async getOrderDetails() {
            await axios.get('/order/get/orders')
            .then(response=>{
                this.order_ids = [];
                response.data.forEach((item)=>{
                    this.order_ids.push(item['id']);
                });
            }).catch(error=>{
                this.order_ids = [];
                console.log(error);
            });
        },
        updateOrderStatus() {
            if (this.id_selected != '' && this.status_selected != '') {
                axios.put('/order/update/'+this.id_selected, {
                    'status': this.status_selected,
                    'id': this.id_selected
                }).then(response=>{
                    this.getOrderDetails();
                    setTimeout(() => {
                        window.location.reload;
                    }, 500);
                }).catch(error=>{
                    console.log(error);
                });
            } else {
                alert('ID and Status must be selected before submit');
            }
        }
    },
    mounted() {
        this.getOrderDetails();
    }
}
</script>