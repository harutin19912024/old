<template>
    <div id="all-sensors">
        <h1>All Sensors</h1>

        <p><router-link :to="{ name: 'create_sensor' }" class="btn btn-primary">Create Sensor</router-link></p>

        <table class="table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Face</td>
                <td>Temperature</td>
                <td>Created</td>
                <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr v-for="sensor in sensors">
                    <td>{{ sensor.id }}</td>
                    <td>{{ sensor.face }}</td>
                    <td>{{ sensor.temperature }}</td>
                    <td>{{ sensor.timestamp }}</td>
                    <td>
                        <router-link :to="{name: 'edit_sensor', params: { id: sensor.id }}" class="btn btn-primary">Edit</router-link>
                        <router-link :to="{name: 'delete_sensor', params: { id: sensor.id }}" class="btn btn-danger">Delete</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                sensors: []
            }
        },

        created: function()
        {
            this.fetchSensorData();
        },

        methods: {
          fetchSensorData: function()
            {
                this.$http.get('http://localhost:8080/sensor').then((response) => {
                  console.log(response)
                    this.sensors = response.data.data;
                    console.log(this.sensors)
                }, (response) => {

                });
            }
        }
    }
</script>
