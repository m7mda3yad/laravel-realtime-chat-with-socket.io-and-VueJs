@extends('layouts.app')
@section('content')
<div class="container">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
            <div class="container">
            <div class="row">
                @if(Session::has('success'))
                <div class="col-6 alert alert-success justify-content-center d-flex">
                    {{Session::get('success')}}
                </div>
            @endif
            <example-component></example-component>

            @foreach (App\Models\Post::paginate(10) as $item )
                <div class="col-8">
                    <div class="col-4">
                        <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" width="100" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">                    </div>
                    <div class="card-body">
                        <h4 lass="card-title" style="{{$item->user->id==Auth::id() ? 'color:red':'color:blue'}}">{{$item->title}}</h5>
                        <p class="card-text "style="        display: block;  text-overflow: ellipsis;  word-wrap: break-word;  overflow: hidden;  max-height: 4.6em; line-height: 2.8em;">{{$item->body}}</p>
                        <ul class="list-inline d-sm-flex my-0">
                            <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                178
                            </a>
                            </li>
                            <li class="list-inline-item g-mr-20">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
                                34
                            </a>
                            </li>
                            <li class="list-inline-item ml-auto">
                            <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
                                <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                                Reply
                            </a>
                            </li>
                        </ul>
                        <div> 
                            <div class="row">
                                @foreach ($item->comments as $comment)
                                @if ($comment->user_id == auth()->user()->id)
                                <div class="col-12"><h3 style="color:blue;float:right">{{$comment->body}}</h3><br></div>
                                @else
                                <div class="col-12"> <h3 style="color:red">{{$comment->body}}</h3><br></div>
                                @endif
                                 @endforeach
                            </div>
                            <div id="post_{{$item->id}}" class="row"></div>
                        </div>
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <input type="hidden" name="post_id" value="{{$item->id}}">
                            <input type="text" class="form-control" name="body" id="body_{{$item->id}}">

                                <button type="button"   onclick="addComment({{$item->id}},{{Auth::id()}})" class="btn submit btn-primary">أضافه ردك</button>
                    </div>
                </div>
            @endforeach

            </div>
            </div>
</div>

@endsection
