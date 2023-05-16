<template>
    <div class="dropdown">
        <a href="#" role="button" aria-expanded="false" aria-haspopup="true" class="dropbtn"><i class="bi bi-bell-fill"></i><span class="badge bg-secondary" v-if="notifications.length > 0">{{notifications.length}}</span></a>
        <div class="dropdown-content">
            <div class="" v-for="(notice, key) in notifications" :key="key">
                <a :href="'/order#' + notice.order_id" v-on:click.prevent="checkedNotification(notice.order_id)">{{notice.message}}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Dropdown",
    data(){
        return {
            notifications : [],
        }
    },
    methods: {
        async getNotifications(){
            await axios.get('/notifications').then(response=>{
                this.notifications = [];
                response.data.forEach((item)=>{
                    if (!item['checked']) {
                        this.notifications.push(item);
                    }
                });
            }).catch(error=>{
                this.notifications = [];
                console.log(error)
            })
        },
        checkedNotification(id) {
            axios.put('/notification/update/'+ id, {
                'checked': true,
                'id': id
            }).then(response=>{
                this.getNotifications()
                setTimeout(() => {
                    window.location.href='/order#' + id;
                }, 500);
            }).catch(error=>{
                console.log(error);
            });
        }
    },
    mounted() {
        this.getNotifications();
    }
}
</script>