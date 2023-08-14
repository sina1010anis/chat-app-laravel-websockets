<template>
    <div class="w-100 my-pos-rel body-one">
        <div class="bg-white page-one shadow rounded overflow-hidden">
            <div class="row p-0 m-0 w-100 h-100">
                <div class="col-3 h-100  m-0 overflow-y-scroll">
                    <a href="/" v-for="(user , index) in users" :key="index" class=" mt-2 rounded-0 my-pointer bn w-100 p-2 d-flex justify-content-between align-items-center">
                        <div class="image-profile overflow-hidden">
                            <img :src="user.image" class="w-100 h-100" :alt="user.name">
                        </div>
                        <div class="my-color-b-500 name-profile d-flex justify-content-center align-items-center ">
                            <div class=" my-font-IYB my-f-15 m-1">{{ user.name }}</div>
                            <div :id="'status_online_'+user.id" :class="(user.status == 1) ? 'status-online' : 'status-offline'"></div>
                        </div>
                    </a>
                </div>

                <div class="col-9 h-100 m-0">
                    <div v-if="box_msg">
                        if
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
    users_data: null,
  }),
  mounted: () => {
    Echo.channel(`test_channel`).listen("TestEvent", (e) => {
      console.log(e.msg);
    });

    Echo.join(`status.user`)
      .here((users) => {
        // ...
      })
      .joining((user) => {
        axios.post("/edit/status", { status: "online", user: user }).then((res) => {
          $("#status_online_" + user.id).removeClass("status-offline");
          $("#status_online_" + user.id).addClass("status-online");
          console.log(user);
        });
      })
      .leaving((user) => {
        axios.post("/edit/status", { status: "ofline", user: user }).then((res) => {
            $("#status_online_" + user.id).removeClass("status-online");
            $("#status_online_" + user.id).addClass("status-offline");
            console.log(user);
        });
      })
      .error((error) => {
        console.error(error);
      });
  },
  props: {
    users: Object,
    box_msg:String
  },
};
</script>
