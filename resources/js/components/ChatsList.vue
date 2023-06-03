<template>
    <div v-if="isLoaded" class="chat-container" style="visibility: visible">
        <div class="users-container">
            <ul>
                <li v-for="(user, index) in users" :key="index" @click="selectUser(user)"
                    :class="{active: user.id && currentUser === user.id}">
                    <a v-bind:href="'#'+user.id">
                        {{ user.name }}
                    </a>

                </li>
            </ul>
        </div>
        <div class="messages-container">
            <ul>
                <li v-for="(message, index) in messages" :key="index" v-bind:id="'#'+user.id">
                    <div v-if="message.sender ==user.id">{{ message.content }}</div>
                    <div v-else class="message-from-other-user">
                        <div>{{ message.sender_user.name }}</div>
                        <div>{{ message.content }}</div>
                    </div>
                </li>
            </ul>
            <form @submit.prevent="sendMessage">
                <input v-model="newMessage" placeholder="Введите ваше сообщение..."/>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
    <div v-else-if="!isLoaded" style="visibility: hidden">

    </div>
</template>

<script>
import Echo from "laravel-echo";

const SERVER_URL = "httpы://booksswap.ru";

export default {
    name: 'ChatsList',
    props: {
        user: {
            required: true,
            type: Object
        },

    },
    data() {
        return {
            users: [],
            messages: [],
            chatId: null,
            currentUser: null,
            newMessage: '',
            echo: null,
            isLoaded: false
        }
    },
    created() {
        axios.get('chat/users')
            .then(response => {
                this.users = response.data.users
                if (this.users.length > 0) {
                    let anchor = window.location.hash;
                    if (anchor) {
                        let hash = anchor.substring(anchor.indexOf("#") + 1);
                        let foundUser = this.userExists(hash);
                        console.log(this.users)
                        if (foundUser !== undefined) {
                            this.selectUser(foundUser);
                        }
                    } else {
                        this.selectUser(this.users[0])
                    }

                }
            })

        this.echo = new Echo({
            broadcaster: 'pusher',
            key: '52f22895600e08353c7e',
            cluster: 'eu',
            forceTLS: true,
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }
        })
    },
    methods: {
        selectUser(user) {
            this.isLoaded=false;
            this.currentUser = user.id
            axios.get(`chat/messages/${this.currentUser}`)
                .then(response => {
                    this.messages = response.data.messages
                })
            axios.get(`chat/getChat/${this.currentUser}`)
                .then(response => {
                    this.chatId = response.data.chatId.id
                    this.echo.leave(`chat.${this.chatId}`)
                    this.echo.private(`chat.${this.chatId}`).listen('.send_message', (e) => {
                        this.messages.push(e.message)
                    })
                })
            this.isLoaded = true;

        },
        userExists(userId) {

            return this.users.find((user) => user.id == userId);
        },

        sendMessage() {
            if (this.newMessage !== '') {
                axios.post('chat/send-message', {
                    receiver: this.currentUser,
                    content: this.newMessage
                }).then(response => {
                    console.log(this.chatId)
                    if (this.chatId == null) {
                        this.echo.leave(`chat.${this.chatId}`)
                        this.echo.private(`chat.${this.chatId}`).listen('.send_message', (e) => {
                            console.log(e)
                        })
                    }
                    this.newMessage = ''
                })
            }
        }
    }
};
</script>

<style scoped>
.chat-container {
    display: flex;
    min-width: 100%;
    font-size: 16px;
}

.users-container {
    width: 40%;
    background-color: #f0f0f0;
    padding: 1rem;
}

.users-container .active {
    font-weight: bold;
}

.messages-container {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.messages-container ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow-y: scroll;
    flex: 1;
}
.message-from-other-user{
    background: #80808026;
    border-radius: 5px;
}
.messages-container input {
    flex: 1;
    margin-right: 1rem;
}

.messages-container form {
    display: flex;
}
</style>
