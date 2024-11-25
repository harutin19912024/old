<template>
    <div id="update-sensor">
        <h1>Update sensor</h1>

        <p><router-link :to="{ name: 'all_sensors' }">Return to sensors</router-link></p>

        <notification v-bind:notifications="notifications"></notification>

        <form v-on:submit.prevent="editsensor">
            <div class="form-group">
                <label name="sensor_id">ID</label>
                <input type="text" class="form-control" disabled v-model="sensor.id" id="sensor_id">
            </div>

            <div class="form-group">
                <label name="sensor_name">Face</label>
                <input type="text" class="form-control" v-model="sensor.face" id="sensor_face" required>
            </div>

            <div class="form-group">
                <label name="sensor_temperature">temperature</label>
                <input type="text" class="form-control" v-model="sensor.temperature" id="sensor_temperature" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
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

            editsensor: function()
            {
                // Validation
                var temperature = parseFloat(this.sensor.temperature);
                if(isNaN(temperature))
                {
                    this.notifications.push({
                        type: 'danger',
                        message: 'temperature must be a number'
                    });
                    return false;
                }

                this.sensor.temperature = parseFloat(this.sensor.temperature);

                this.$http.put('http://localhost:8080/sensor/' + this.$route.params.id, this.sensor, {
                    headers : {
                        'Content-Type' : 'application/json'
                    }
                }).then((response) => {
                    this.notifications.push({
                        type: 'success',
                        message: 'Sensor updated successfully'
                    });
                }, (response) => {
                    this.notifications.push({
                        type: 'error',
                        message: 'Sensor not updated'
                    });
                });
            }
        },

        components: {
            'notification' : Notification
        }
    }
</script>
