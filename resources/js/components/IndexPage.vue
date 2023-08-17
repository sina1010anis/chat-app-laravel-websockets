<template>
    <div class="w-100 my-pos-rel body-one">
        <div class="bg-white page-one shadow rounded overflow-hidden">
            <div class="row p-0 m-0 w-100 h-100">
                <div class="col-3 h-100  m-0 overflow-y-scroll" style="z-index:5">
                    <a :href="'/show/message/'+user.name" v-for="(user , index) in users" :key="index" class=" mt-2 rounded-0 my-pointer bn w-100 p-2 d-flex justify-content-between align-items-center">
                        <div v-if="new_message.includes(user.id)" :id="'user_message_'+user.id" class="image-profile overflow-hidden foucs-new-message">
                            <img :src="'/'+user.image" class="w-100 h-100" :alt="user.name">
                            <div :id="'status_online_'+user.id" :class="(user.status == 1) ? 'status-online' : 'status-offline'" class="view-status-user"></div>
                        </div>
                        <div v-else class="image-profile overflow-hidden" :id="'user_message_'+user.id">
                            <img :src="'/'+user.image" class="w-100 h-100" :alt="user.name">
                            <div :id="'status_online_'+user.id" :class="(user.status == 1) ? 'status-online' : 'status-offline'" class="view-status-user"></div>
                        </div>
                        <div class="my-color-b-500 name-profile d-flex justify-content-center align-items-center ">
                            <div class=" my-font-IYB my-f-15 m-1">{{ user.name }}</div>
                        </div>
                    </a>
                </div>

                <div class="col-9 h-100 m-0 p-0">
                    <div v-if="box_msg">
                        <div class="w-100 p-4 shadow d-flex justify-content-between align-items-center" style="height: 12vh;">
                            <div class="my-font-IYB my-f-19 m-1">
                                {{ name.name }}
                            </div>
                            <div class="image-profile overflow-hidden my-sc-1-5">
                                <img :src="'/'+name.image" class="w-100 h-100"  :alt="name.name">
                            </div>
                        </div>
                        <div v-if="data_messages == null" class="w-100 box-message overflow-y-scroll p-3" style="height: 70.5vh;">
                            <div v-for="(msg , index) in messages" @key="index" >
                                <div :class=" (msg.user_id == user.id) ? 'msg my-2 px-2 py-1 rounded   msg-am' : 'msg my-2 px-2 py-1 rounded   msg-you'" >
                                    <p  dir="rtl" class=" text-end pt-2 my-font-IYM my-f-16 my-color-bl">{{msg.body}}</p>
                                    <hr class="bg-secondary p-0 m-0">
                                    <p class="my-font-IYL my-f-13 my-color-b-500 p-0 py-1 m-0">{{msg.created_at}}</p>
                                </div>
                            </div>
                        </div>
                        <div v-else class="w-100 box-message overflow-y-scroll p-3" style="height: 70.5vh;">
                            <div v-for="(msg , index) in data_messages" @key="index" >
                                <div :class=" (msg.user_id == user.id) ? 'msg my-2 px-2 py-1 rounded   msg-am' : 'msg my-2 px-2 py-1 rounded   msg-you'" >
                                    <p  dir="rtl" class=" text-end pt-2 my-font-IYM my-f-16 my-color-bl">{{msg.body}}</p>
                                    <hr class="bg-secondary p-0 m-0">
                                    <p class="my-font-IYL my-f-13 my-color-b-500 p-0 py-1 m-0">{{msg.created_at}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center" style="height: 10vh;">
                            <div class="Message">
                                <input v-model="body_message" @keyup.enter="sendMessage" title="Write Message" tabindex="i" pattern="\d+" placeholder="Message.." class="MsgInput" type="text">
                                <svg @click="sendMessage" xmlns="http://www.w3.org/2000/svg" version="1.0" width="30.000000pt" height="30.000000pt" viewBox="0 0 30.000000 30.000000" preserveAspectRatio="xMidYMid meet" class="SendSVG my-pointer">
                                    <g transform="translate(0.000000,30.000000) scale(0.100000,-0.100000)" fill="#ffffff70" stroke="none">
                                        <path d="M44 256 c-3 -8 -4 -29 -2 -48 3 -31 5 -33 56 -42 28 -5 52 -13 52 -16 0 -3 -24 -11 -52 -16 -52 -9 -53 -9 -56 -48 -2 -21 1 -43 6 -48 10 -10 232 97 232 112 0 7 -211 120 -224 120 -4 0 -9 -6 -12 -14z"></path>
                                    </g>
                                </svg><span class="l"></span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <p>Please select the chat you want, then it is possible to send a message...!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery";
export default {
  name: "IndexPage",
  data: () => ({
    version:'version 3Vue',
    users_data: null,
    body_message:null,
    data_messages:null
  }),
  methods: {
    sendMessage()
    {
        if(this.body_message != null)
        {
            axios.post('/send/message' , {msg:this.body_message , user_get:this.name.id , user_send:this.user.id})
                .then((res)=>{this.body_message = null})
        }
    },
    update_message(e)
    {
        if(this.data_messages == null)
        {
            this.data_messages = this.messages;
            this.data_messages.push(e)
        }else{
            this.data_messages.push(e)
        }
    },

  },
  created() {
        Echo.channel(`send-message`).listen("SendMessage", (e) => {
            if(this.messages != ''){
                this.data_messages = this.messages
                this.data_messages.unshift(e)
            }
            if(e.user_get == this.user.id){
                $('#user_message_'+e.user_send).addClass('foucs-new-message')
                return new Audio('/MT.mp3').play();
            }
        });

        Echo.join(`status.user`)
        .here((users) => {
            // ...
        })
      .joining((user) => {
        axios.post("/edit/status", { status: "online", user: user }).then((res) => {
          $("#status_online_" + user.id).removeClass("status-offline");
          $("#status_online_" + user.id).addClass("status-online");
          //console.log(user);
        });
      })
      .leaving((user) => {
        axios.post("/edit/status", { status: "ofline", user: user }).then((res) => {
            $("#status_online_" + user.id).removeClass("status-online");
            $("#status_online_" + user.id).addClass("status-offline");
            //console.log(user);
        });
      })
      .error((error) => {
        console.error(error);
      });
  },

  props: {
    users: Object,
    box_msg:String,
    name:Object,
    messages:Object,
    user:Object,
    new_message:Object
  },
};
</script>
