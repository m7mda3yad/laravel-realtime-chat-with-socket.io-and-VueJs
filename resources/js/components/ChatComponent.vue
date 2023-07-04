<template>
    <div class="">
    </div>
</template>
<script>
    export default {
    name: 'chat-component',
    data(){
        return {}
    },
        mounted(){
            window.Echo.channel('new-message').listen('NewMessage',event=>
            {
                var data = event;
                var user_id = document.getElementById('user_id').value;
                if(user_id!=data.user_id)
                    document.getElementById('new_message').innerHTML += '<div class="message"><div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"><div class="online"></div></div><p class="text">'+data.body+'</p></div>' ;
                else
                    document.getElementById('new_message').innerHTML += '<div class="message text-only"><div class="response"><p class="text">'+data.body+'</p></div></div>';
            })
        }
    }
</script>