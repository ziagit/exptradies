@extends('layouts.blog')

@section('content')

<div class="container">
    <nav class="navbar navbar-light bg-light d-flex justify-content-between">
        <div class="">
            <a class="navbar-brand d-flex" href="/">
            <img src="{{asset('images/home/logo_text.png')}}" alt="" width="120" height="50" class="d-inline-block align-text-top mr-2">
            </a>
        </div>
    </nav>
</div>

<div class="container content">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-outline-primary back-btn" href="/blog">Back to posts</a>
      <div class="card">
          <img src="https://picsum.photos/900/250/?image=3" class="card-img-top" alt="...">
          <div class="card-body">
              <h5 class="card-title">{{$details->title}}</h5>
              <p class="card-text">{!!$details->body!!}</p>
              <div class="text-right">
              </div>
          </div>
      </div>

      <div class="comment-input">
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('comment-form')}}">
        @csrf
        <input type="hidden" name="blogId" value="{{$details->id}}">
          <div class="form-group">
            <input type="text" id="title" name="name" class="form-control" required placeholder="Name">
          </div>
          <div class="form-group">
            <textarea rows="5" name="comment" class="form-control" required placeholder="Type your comment"></textarea>
          </div>
          <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
      </div>
      <div class="comment-container">
        @foreach($details->comments->reverse() as $comment)
        <div class="mb-5">
          <div class="d-flex align-items-center mb-3">
            <img src="{{asset('images/user-avatar.png')}}" alt="Commenter avatar" width="35" height="35">
            <div>
              <p class="mb-0 ml-3 font-weight-bold ">{{$comment->name}}</p>
              <small class="mb-0 ml-3 text-secondary">{{$comment->created_at}}</small>
            </div>
          </div>
          <p>{{$comment->comment}}</p>
        </div>
        @endforeach
      </div>
    </div>
   
  </div>
    
</div>
@endsection