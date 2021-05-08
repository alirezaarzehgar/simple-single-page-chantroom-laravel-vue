<template>
    <div
        class="chat-container container d-flex flex-column justify-content-between"
    >
        <div class="chats border mb-2 d-flex flex-column">
            <message
                v-for="(message, index) in messages"
                :key="index"
                :text="message.message"
                :user_id="message.user_id"
                :current_user="user_id"
            ></message>
        </div>

        <div class="input w-100 d-flex flex-row justify-content-between">
            <textarea
                class="w-100 mr-3"
                type="text"
                v-model="newMessage"
                @blur="addMessage"
                placeholder="Enter your message"
            ></textarea>
            <button class="btn btn-secondary" @click="addMessage">send</button>
        </div>
    </div>
</template>

<script>
import Message from "./Message";

export default {
    props: ["user_id"],
    data() {
        return {
            messages: [],
            newMessage: ""
        };
    },
    methods: {
        addMessage() {
            if (this.newMessage.length == 0) return;

            this.messages.push({
                message: this.newMessage,
                user_id: this.user_id
            });

            axios
                .post("api/messages", {
                    message: this.newMessage,
                    userId: this.user_id
                }).then(r => {
                    var container = this.$el.querySelector(".chats");
                    container.scrollTop = container.scrollHeight;
                });

            this.newMessage = "";
        },
        getAllMessages() {
            axios.get("api/messages").then(response => {this.messages = response.data;});
        }
    },
    created() {
        this.getAllMessages();

        window.Echo.channel("chat.message").listen("Message", e => {
            this.messages.push({
                message: e.message,
                user_id: e.userId
            });
        });
    },
    components: { Message }
};
</script>

<style scoped>
.chats {
    height: 600px;
    overflow: auto;
}

textarea {
    resize: none;
}
</style>
