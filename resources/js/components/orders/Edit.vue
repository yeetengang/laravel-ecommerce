<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Order</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" v-model="order.status">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:"update-order",
    data(){
        return{
            order:{
                status:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showOrder()
    },
    methods:{
        async showOrder(){
            await axios.get('/api/order/'+this.$route.params.id).then(response=>{
                const {status, total} = response.data
                this.order.status = status
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post('/api/order/'+this.$route.params.id, this.order).then(response=>{
                this.$router.push({name:"orderList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>