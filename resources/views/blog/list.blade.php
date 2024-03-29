@extends('layouts.blog')

@section('content')
<div class="container">
    <nav class="navbar navbar-light bg-light d-flex justify-content-between">
        <div class="">
            <a class="navbar-brand d-flex" href="/">
            <img src="{{asset('images/home/logo_text.png')}}" alt="" width="150"  class="d-inline-block align-text-top mr-2">
            </a>
        </div>
       
        <form class="form-inline" method="get" action="blog/search">
            @csrf
            <div class="input-group d-flex align-items-center">
                <input  name="keyword" type="search" class="form-control " placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button  class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </nav>
</div>
<div class="container content">
    <div class="row">
                @foreach($blogs as $blog)
                <div class="col-sm-12, col-md-4 col-lg-4 my-3">
                    <div class="card">
                        @if(isset($blog->image) && !empty($blog->image))
                        <img src="{{asset('storage/images/blog/'.$blog->image)}}" class="card-img-top" alt="Post image">
                        @else
                        <img src="https://placekitten.com/1000/300" class="card-img-top" alt="Post image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{$blog->title}}</h5>
                            <p class="card-text">{!!Str::limit($blog->body,100)!!}</p>
                            <div class="text-right">
                            <a class="btn" href="/blog/details/{{$blog->id}}">More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
    </div>
</div>

@endsection