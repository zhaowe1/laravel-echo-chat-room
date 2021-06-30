<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app"></div>
    </body>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        let groupId = 1;
        // window.Echo.private('wechat.group.' + groupId).listen('UserSendMessage', event => {
        //     console.log(event.userId + ' Says ' + event.message);
        // })

        window.Echo.join('wechat.group.' + groupId)
            .here((users) => {
                console.log(users);
            })
            .joining((user) => {
                console.log(user.name);
            })
            .leaving((user) => {
                console.log(user.name);
            })
            .listen('UserEnterGroup', event => {
            // 监听&接收服务端广播的消息
            console.log(event.userId + '加入了群聊');
        });
    </script>
</html>
