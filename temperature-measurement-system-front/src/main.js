import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueResource from 'vue-resource';
Vue.use(VueResource);

import App from './App.vue'

const AllSensors = require('./assets/js/components/all-sensors.vue');
const CreateSensor = require('./assets/js/components/create-sensor.vue');
const EditSensor = require('./assets/js/components/edit-sensor.vue');
const DeleteSensor = require('./assets/js/components/delete-sensor.vue');

const routes = [
    {
        name: 'all_sensors',
        path: '/',
        component: AllSensors
    },
    {
        name: 'create_sensor',
        path: '/sensors/create',
        component: CreateSensor
    },
    {
        name: 'edit_sensor',
        path: '/sensors/edit/:id',
        component: EditSensor
    },
    {
        name: 'delete_sensor',
        path: '/sensors/delete/:id',
        component: DeleteSensor
    }
];
var router = new VueRouter({ routes: routes, mode: 'history' });
new Vue(Vue.util.extend({ router }, App)).$mount('#app');
