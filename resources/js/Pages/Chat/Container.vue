<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               <chat-room-selection
               v-if="CurrentRoom.id"
               :rooms="ChatRooms"
               :currentRoom="CurrentRoom"
               v-on:roomChanged="SetRoom($event)"
               />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="Messages"/>
                    <input-message :room="CurrentRoom" v-on:messageSent="GetMessages()"/>
                    
                    
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ChatRoomSelection from './ChatRoomSelection.vue'
    import InputMessage from './InputMessage.vue'
    import MessageContainer from './MessageContainer.vue'



    export default {
        components: {
            AppLayout,
            ChatRoomSelection,
            InputMessage,
            MessageContainer,
        },

        data:function(){
            return{
                ChatRooms:[],
                CurrentRoom:[],
                Messages:[],
            }
        },

        methods:{
            GetRooms:function(){
                axios.get('/chat/rooms')
                  .then(response=> {
                    this.ChatRooms=response.data;
                    this.SetRoom(response.data[0]);

                  })
                  .catch(error=>{
                        // handle error
                        console.log(error);
                      })
            },

            SetRoom(room){
                this.CurrentRoom=room;
                this.GetMessages();
            },

            GetMessages(){
                axios.get('/chat/room/' + this.CurrentRoom.id + '/messages')
                  .then(response=> {
                    this.Messages=response.data;

                  })
            }
            
        },
        created(){
                this.GetRooms();
            }
    }
</script>
