@extends('layouts.app',['title'=>$title])

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <x-posts-section :posts="$posts"/>

                </div>
            </div>
        </div>

        @if(isset($categories) && (count($categories)>0))
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">Category</div>

                <div class="card-body">
                    <nav class="nav">
                        @foreach ($categories as $category )
                            <a class="nav-link" href="{{route('category.posts',['id'=>$category->enc_id])}}">{{$category->name}}</a>
                        @endforeach
                    </nav>

                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
