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
        <div class="col-md-8">
            <div class="card mb-3" style="max-width: 100%">
                <div class="row g-0">
                    <div class="col-md-4">
                    
                        @if(isset($blog->image) && !empty($blog->image))
                        <img src="{{asset('storage/images/blog/'.$blog->image)}}" class="card-img-top" alt="Post image">
                        @else
                        <img class="post-img" src="https://placekitten.com/300/300" class="img-fluid rounded-start" alt="Post image">
                        @endif
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$first->title}}</h5>
                        <p class="card-text"><small class="text-muted">Posted 3 mins ago</small></p>
                        <p class="card-text">{!!Str::limit($first->body,100)!!}</p>
                        <div class="text-right">
                            <a class="btn" href="/blog/details/{{$first->id}}">More</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h2>All the latest</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($blogs as $blog)
                <div class="col my-2">
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
            <div class="d-flex mt-5">
                {!! $blogs->links() !!}
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="mx-3"><h5>Top news</h5></div>
            @foreach($tops as $top)
                <div class="col mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$top->title}}</h5>
                            <p class="card-text">{!!Str::limit($top->body,50)!!}</p>
                            <div class="text-right">
                                <a class="btn" href="/blog/details/{{$top->id}}">More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
       
    </div>

</div>

@endsection