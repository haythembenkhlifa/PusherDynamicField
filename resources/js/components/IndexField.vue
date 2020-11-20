<template>
      <span v-bind:class="myclass" v-bind:style="mystyle">{{ value }}</span>
</template>

<script>

import Pusher from "pusher-js";

export default {
    props: ['resourceName', 'field'],

    data() {
        return {
            value: this.field.value,
            badgesMapArray:[],
            listOfClasses:[],
            myclass:"",
            mystyle:""
        };
    },
    methods: {
        setFieldClass()
            {

            if (this.field.badgesMap) {
                if ( this.listOfClasses[this.badgesMapArray[this.value]]) {
                    this.myclass = this.listOfClasses[this.badgesMapArray[this.value]];
                    this.mystyle="";
                }else
                {
                    this.myclass = "px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";
                    this.mystyle="background-color:"+this.badgesMapArray[this.value]+";";
                }

            }
            }
    },
    mounted() {

        this.listOfClasses['primary']="bg-primary px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
        this.listOfClasses['success']="bg-success px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
        this.listOfClasses['danger']="bg-danger px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
        this.listOfClasses['warning']="bg-warning px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";
        this.listOfClasses['info']="bg-info px-2 py-1 rounded-full uppercase text-xs font-bold text-white";

        if (this.field.badgesMap) {
        const resultObject = Array.of(JSON.parse(JSON.stringify(this.field.badgesMap)))[0];

            Object.keys(resultObject).map((field) => {
                this.badgesMapArray[field] = resultObject[field];
            });
        }

        this.setFieldClass();

         this.pusherId = this.field.pusherId;
         this.pusherCluster = this.field.pusherCluster;

        var pusher = new Pusher(this.pusherId, {
            cluster: this.pusherCluster,
            authEndpoint: "/broadcasting/auth",
            auth: {
                headers: {
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
                }
            }
        }).bind(this);

        var channel = pusher.subscribe("private-"+this.field.channelName);

        channel.bind(
            "my-event",
            function(recievedData) {
                try {
                    this.value = recievedData['value'];
                    this.setFieldClass();
                } catch (error) {

                }
            },
            this
        );
    },
};
</script>
