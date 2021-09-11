<template>
<div>
    <div class="p-6 border ">
        <div class="text-center text-sm">Input Message</div>
        <div class="mt-0 md:mt-4 md:m-2">
            <div v-if="emptyInput" class="text-center">pls type something ...</div>
            <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="message"
                :class="{ 'border-red-500' : message.lenght}" required autofocus autocomplete="name"
                 @keyup.enter="sendMessage" @focus="emptyInput = false"  placeholder="write..."
                 />
            <jet-button @click="sendMessage" class="mt-2 place-content-center">send</jet-button>
        </div>

    </div>
</div>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    // import axios from 'axios'

export default {
    components: {
        JetButton,
        JetInput,
    },
    props: ['room'],
    emits: ['messageSent'],
    data () {
        return {
            message: '',
            emptyInput: false,
        }
    },
    methods: {
        sendMessage() {
            if(this.message.length === 0) {
                this.emptyInput = true;
                return;
            }
            this.emptyInput = false;
            axios.post(`/chat/room/${this.room.id}/newMessage`, {
                message: this.message
            })
            .then( res => {
                if( res.status === 201 ) {
                    this.message = '';
                    this.$emit('messageSent')
                }
            })
            .catch( error => {
                console.log(error)
            })
        }
    },
}
</script>
