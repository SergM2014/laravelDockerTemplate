import './bootstrap';

import { createApp } from 'vue'

createApp({
    data() {
        return {
            count: 0
        }
    },
    created() {
        Echo.channel('notification')
            .listen('MessageNotification', (e) =>{
                console.log(e)
            });

    }
}).mount('#app')
