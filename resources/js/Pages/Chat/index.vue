<template>
    <app-layout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl pb-8 rounded-lg">
                    <!-- <welcome /> -->
                    <section>
                        <div class="font-bold text-xl text-gray-500 leading-4 text-center py-4 borber border-b">
                            Chat Home
                        </div>
                        <section class="max-w-7xl mt-2 mx-auto sm:px-6 lg:px-8">
                            <!-- room selection  -->
                            <chat-room-selection
                                v-if="currentRoom.id" :rooms="chatRooms" :currentRoom="currentRoom"
                                @roomChanged="setRoom( $event )"
                            />
                            <!-- messages box -->
                            <message-box :messages="messages"/>
                            <!-- send message input -->
                            <inputMessage :room="currentRoom" @messageSent="sendMessageSuccessful" />
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import chatRoomSelection from '@/components/chatRoomSelection';
    import messageBox from '@/components/messageBox';
    import inputMessage from '@/components/inputMessage';
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
            chatRoomSelection,
            messageBox,
            inputMessage,
        },
        data() {
            return {
                chatRooms: [],
                currentRoom: [],
                messages: [],
            }
        },
        watch: {
            currentRoom(val, oldVal) {
                if( oldVal.id ) {
                    this.disConnect( oldVal );
                }
                this.connect();
            }
        },
        methods: {
            connect() {
                if( this.currentRoom.id ) {
                    let vm = this;
                    this.getMasseges();
                    window.Echo.private("chat." + this.currentRoom.id)
                    .listen('.message.new', e => {
                        vm.getMasseges();
                    })
                }
            },
            disConnect( room ) {
                window.Echo.leave("chat." + room.id);
            },
            getrooms() {
                axios.get(this.route('rooms'))
                .then( res => {
                    this.chatRooms = res.data;
                    if(this.chatRooms.length !== 0) {
                        this.setRoom(res.data[0])
                    }
                })
                .catch( error => {
                    console.log(error)
                })
            },
            setRoom( room ) {
                this.currentRoom = room;
                if(this.currentRoom.lenght !== 0) {
                    this.getMasseges();
                }
            },
            getMasseges(val) {
                axios.get(this.route('messages', [this.currentRoom.id]))
                .then( res => {
                    this.messages = res.data;
                    console.log(res.data)
                })
                .catch( error => {
                    console.log( error );
                })
            },
            sendMessageSuccessful() {
               console.log('message yes')
               this.getMasseges();
            }
        },
        created() {
            this.getrooms();
        },
    })
</script>
