<template>
    <div class="">


    </div>
</template>

<script>
    export default {
    name: 'example-component',
    data(){
        return {}
    },
        mounted(){
            window.Echo.channel('new-notification').listen('NewNotification',event=>
            {
                var data = event;
                var user_id = document.getElementById('user_id').value;
                if(user_id==data.user_id)
                    document.getElementById('post_'+data.post_id).innerHTML += "<div class=\"col-12\"><h3 style=\"color:blue;float:right\">"+data.body+"</h3><br></div>";
                else
                    document.getElementById('post_'+data.post_id).innerHTML += "<div class=\"col-12\"> <h3 style=\"color:red\">"+data.body+"</h3><br></div>";
            })

        }
    }
</script>