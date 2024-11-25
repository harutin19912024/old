<template>
    <div id="create-sensor">
        <h1>Create Sensor</h1>

        <p><router-link :to="{ name: 'all_sensors' }">Return to sensors</router-link></p>

        <notification v-bind:notifications="notifications"></notification>

        <form v-on:submit.prevent="addSensor">
            <div class="form-group">
                <label name="product_id">ID</label>
                <input type="text" class="form-control" disabled v-model="sensor.id" id="sensor_id">
            </div>

            <div class="form-group">
                <label name="product_name">Sensor Face</label>
                <input type="text" class="form-control" v-model="sensor.face" id="sensor_face" required>
            </div>

            <div class="form-group">
                <label name="product_temperature">Temperature</label>
                <input type="text" class="form-control" v-model="sensor.temperature" id="sensor_temperature" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Create</button>
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

        methods: {
          addSensor: function()
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
                } else {
                    this.sensor.temperature = parseFloat(this.sensor.temperature);
                }

                this.sensor.created = Math.round(+new Date()/1000);

                this.$http.post('http://localhost:8080/sensor', this.sensor, {
                    headers : {
                        'Content-Type' : 'application/json'
                    }
                }).then((response) => {
                    this.notifications.push({
                        type: 'success',
                        message: 'Sensor created successfully'
                    });
                }, (response) => {
                    this.notifications.push({
                        type: 'error',
                        message: 'Sensor not created'
                    });
                });
            }
        },

        components: {
            'notification' : Notification
        }
    }
</script>
