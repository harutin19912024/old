<template>
    <div id="delete-product">
        <h1>Delete Sensor {{ sensor.id }}</h1>

        <p><router-link :to="{ name: 'all_sensors' }">Return to sensors</router-link></p>

        <notification v-bind:notifications="notifications"></notification>

        <form v-on:submit.prevent="deleteSensor">
            <p><button class="btn btn-danger">Delete Sensor</button></p>
        </form>
    </div>
</template>

<script>
    import Notification from './notifications.vue';

    export default{
        data(){
            return{
                sensor:{},
                notifications:[]
            }
        },

        created: function(){
            this.getSensor();
        },

        methods: {
            getSensor: function()
            {
                this.$http.get('http://localhost:8080/sensor/' + this.$route.params.id).then((response) => {
                    this.sensor = response.data.data;
                }, (response) => {

                });
            },

            deleteSensor: function()
            {
                this.$http.delete('http://localhost:8080/sensor/' + this.$route.params.id, this.sensor, {
                    headers : {
                        'Content-Type' : 'application/json'
                    }
                }).then((response) => {
                    this.$router.push({name: 'all_sensors'})
                }, (response) => {
                    this.notifications.push({
                        type: 'danger',
                        message: 'Sensor could not deleted'
                    });
                });
            }
        },

        components: {
            'notification' : Notification
        }
    }
</script>
