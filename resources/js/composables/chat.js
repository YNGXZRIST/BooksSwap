import {ref} from 'vue';
import axios from 'axios';

export default function useChat() {
    const messages = ref([])
    const errors = ref([])
    const chats = ref([])
    let firstChatId = Number()
    const getChats = async () => {
        await axios.get('chat/getChats').then((response) => {
            chats.value = response.data
            firstChatId = response.data[0].id
            console.log(firstChatId)

        })
    }
    const getMessages = async () => {
        await axios.get('chat/messages').then((response) => {
            messages.value = response.data
        })
    }
    const addMessage = async (form) => {
        errors.value = [];

        try {
            await axios.post('chat/sendMessage', form).then((response) => {

                messages.value.push(response.data)
                // console.log(messages.value);
            })
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    return {
        firstChatId,
        chats,
        messages,
        errors,
        getChats,
        getMessages,
        addMessage
    }
}
