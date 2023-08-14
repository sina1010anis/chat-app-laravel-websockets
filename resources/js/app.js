import './bootstrap';

import { createApp } from 'vue';
import $ from 'jquery'
import IndexPage from './components/IndexPage'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.css'

createApp({
    data:()=>({
        version:'Vue 3'
    }),components:{
        IndexPage:IndexPage
    },mounted:()=>{

    }
}).mount('#app')
