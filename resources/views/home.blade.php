@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="container">
                    <form method="get" action="{{route('post.index')}}">
                    <div class="row">
                        <div class="col-12"><br></div>
                        <div class="col-4"><input type="button" value="0" name="all_price" id="all_price"></div>
                        <div class="col-4"></div>
                        <div class="col-4"><a href="{{route('post.index')}}" class="btn btn-primary">post</a></div>
                        <div class="col-4"><a href="{{route('chats.index')}}" class="btn btn-primary">chats</a></div>
                                    <input name="all_price" value="0" type="hidden" id="all_price_hidden">
                        <div class="col-12"><br></div>
                    <div class="col-12"><br></div>
                    <div class="col-12"><input type="button" value="0" name="all_price" id="all_price"></div>
                                <input name="all_price" value="0" type="hidden" id="all_price_hidden">
                    <div class="col-12"><br></div>
                        <div class="col-12"><input type="submit" value="submit" ></div>
                    <div class="col-12"><br></div>
                                @foreach (App\Models\Post::where('id','<',100)->get() as $item)
                                    <div class="col-4">
                                        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg>
                                            <div class="card-body">
                                            <h4 style="color:blue" class="card-title ">{{$item->title}}</h5>
                                            <p class="card-text "style="        display: block;  text-overflow: ellipsis;  word-wrap: break-word;  overflow: hidden;  max-height: 4.6em; line-height: 2.8em;">{{$item->body}}</p>
                                            <p>{{$item->price}}</p>
                                            <button type="button"onclick="addPost({{$item->price}})">add</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                </div>

                    </div>
            </div>
        </div>
    </div>
</div>
<script>
  function  addPost(price)
  {
    document.getElementById('all_price').value=parseInt(document.getElementById('all_price').value)+parseInt(price);
    document.getElementById('all_price_hidden').value=parseInt(document.getElementById('all_price').value)+parseInt(price);
  }
</script>
@endsection
