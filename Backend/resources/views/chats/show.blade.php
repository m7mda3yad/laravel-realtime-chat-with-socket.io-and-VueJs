
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="{{ asset('css/chats.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <div id="app" >
        <div class="container" >
            <div class="row">
            <nav class="menu">
                <ul class="items">
                <li class="item"><i class="fa fa-home" aria-hidden="true"></i></li>
                <li class="item"><i class="fa fa-user" aria-hidden="true"></i></li>
                <li class="item"><i class="fa fa-pencil" aria-hidden="true"></i></li>
                <li class="item item-active"><i class="fa fa-commenting" aria-hidden="true"></i></li>
                <li class="item"><i class="fa fa-file" aria-hidden="true"></i></li>
                <li class="item"><i class="fa fa-cog" aria-hidden="true"></i></li>
                </ul>
            </nav>
            <chat-component></chat-component>

            <section class="discussions">
                <div class="discussion search">
                <div class="searchbar"><i class="fa fa-search" aria-hidden="true"></i>
                    <input type="text" placeholder="Search...">
                </div>
                </div>
            
            
                @foreach ($users as $item )
                    <a href="{{route('chats.show',$item->id)}}" class="discussion {{$item->id==$user->id?'message-active':''}}">
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                <div class="online"></div>
                            </div>
                            <div class="desc-contact">
                                <p class="name">{{$item->name}}</p>
                                <p class="message">{{$item->email}}</p>
                            </div>
                    </a>
                @endforeach
            </section>
            <section class="chat">
                <div class="header-chat">
                <i class="icon fa fa-user-o" aria-hidden="true"></i>
                <p class="name">Megan Leib</p>
                <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                <div class="messages-chat" id="new_message">
                
                    @foreach ($chat->messages as $message)
                        @if($message->sender!=auth()->user()->id)
                            <div class="message">
                                <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                                <div class="online"></div>
                                </div>
                                <p class="text"> {{$message->body}} </p>
                            </div>    
                        @else
                            <div class="message text-only">
                                <div class="response">
                                <p class="text"> {{$message->body}}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach

                </div>
                <div class="footer-chat">
                    <input type="hidden" id="chat_id" value="{{$chat->id }}">
                    <input type="hidden" id="user_id" value="{{auth()->user()->id}}">
                <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                <input type="text" id="message_input" class="write-message" placeholder="Type your message here">
                <i class="icon send fa fa-paper-plane-o clickable" id="send_icon" aria-hidden="true"></i>
                </div>
            </section>
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <script>
    $(document).ready(function(){
	  $("#send_icon").click(function(){

            var chat_id = document.getElementById('chat_id').value;
            var user_id = document.getElementById('user_id').value;
            var body  = document.getElementById("message_input").value;

            if(body!=null && body!='')
            {
                data={'chat_id':chat_id,"user_id":user_id,"body":body};

              async function postData(url = '{{route('message.store')}}', data) {
                const response = await fetch(url, {
                  method: 'POST',    mode: 'cors',   cache: 'no-cache',   credentials: 'same-origin', 
                  headers: { 'Content-Type': 'application/json'   },
                  redirect: 'follow',   referrerPolicy: 'no-referrer', 
                  body: JSON.stringify(data)  
                });
                return response.json();  
              }
              postData('{{route('message.store')}}', {'chat_id':chat_id,"user_id":user_id,"body":body}).then((data) => {});

        }

    });
	});
</script>
    