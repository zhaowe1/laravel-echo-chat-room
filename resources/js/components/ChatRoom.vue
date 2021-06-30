<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat Room</div>

                    <div v-for="msg in roomMessages" class="card-body">
                        [{{ msg.user.name }}] :
                        {{ msg.message }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="readySendMessage">Message</label>
                    <textarea id="readySendMessage" class="form-control" v-model="readySendMessage" rows="3"></textarea>
                </div>
                <button type="submit" @click="sendMessage" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            'roomMessages': [],
            'readySendMessage': '',
            'room': null,
        }
    },
    methods: {
        joinRoom: function () {
            this.room = window.Echo.join('wechat.group.main')
                .here((users) => {
                    let userList = '';
                    for (let i = 0; i < users.length; i++) {
                        userList += users[i].name + ', ';
                    }
                    userList = userList.substr(0, userList.length - 2)
                    this.roomMessages.push({
                        'user': {'name': 'system'},
                        'message': 'you have joined the chat room. Current users are: ' + userList
                    })
                })
                .joining((user) => {
                    this.roomMessages.push({'user': {'name': 'system'}, 'message': user.name + ' joining.'})
                })
                .leaving((user) => {
                    this.roomMessages.push({'user': {'name': 'system'}, 'message': user.name + ' leaving.'})
                })
                .listen('UserSendMessage', event => {
                    console.log(event);
                    this.roomMessages.push(event);
                }).listenForWhisper('UserSendMessage', event => {
                    console.log(event);
                    this.roomMessages.push(event);
                });
        },
        sendMessage: function () {
            console.log(this.readySendMessage)
            let data = {'user': {'name': window.currentUserName}, 'message': this.readySendMessage}
            this.room.whisper('UserSendMessage', data);
            this.roomMessages.push(data)
            this.readySendMessage = '';
        }
    },
    mounted() {
        this.joinRoom();
    }
}
</script>
