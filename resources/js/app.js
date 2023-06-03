import './bootstrap';

import {createApp} from 'vue';
import ChatsList from "./components/ChatsList.vue";

const app = createApp({
    components: {
        ChatsList
    }
})

app.mount('#app')
