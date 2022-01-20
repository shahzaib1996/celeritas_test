@extends('layouts.app',['title'=>$post->name])
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mx-autox">
            <div class="jumbotron">
                <p class="text-muted m-0 p-0" title="Category"> {{$post->category->name}}</p>
                <h1 class="display-4">{{$post->name}}</h1>
                <p class="lead">
                    {{$post->description}}
                </p>    

                <hr class="my-4">
                <div class="card-columns">
                    @foreach ($post->images as $image)
                        <div class="card">
                            <img class="card-img-top" src="{{$image->image_path}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            
            <h3>Comments</h3>
            <div class="card">
                <div class="card-body">
                    @forelse ($post->comments as $comment)
                        <div>
                            <h5 class="card-title">{{$comment->user->name}}</h5>
                            <p class="card-text">{{$comment->comment}}</p>
                            <hr class="my-4">
                        </div>
                    @empty
                        <div>
                            <p class="card-text text-center">No Comments Found</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card mt-4">

                <div class="card-body">
                    <form action="{{route('post.comment',['post'=>$post->id])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Write a comment</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                            @error('comment')
                                <small class="form-text text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
@endpush
