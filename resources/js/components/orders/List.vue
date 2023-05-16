<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Order</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="orders.length > 0">
                                <tr v-for="(order,key) in orders" :key="key">
                                    <td>{{ order.id }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>{{ order.total }}</td>
                                    <td>
                                        <router-link :to='{ name:"orderEdit" , params:{ id:order.id } }' class="btn btn-success">Edit</router-link>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Order Available.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"orders",
    data(){
        return{
            orders:[]
        }
    },
    mounted(){
        this.getOrders()
    },
    methods:{
        async getOrders(){
            await axios.get('/api/order').then(response=>{
                this.orders = response.data
            }).catch(error=>{
                console.log(error)
                this.orders = []
            })
        },

    }
}
</script>