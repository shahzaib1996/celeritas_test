@forelse($posts as $post)
    <div class="col-md-4 mb-2">
        <div class="card" stylex="width: 18rem;">
            <img src="{{$post->getPrimaryImages()}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->name}}</h5>
                <p class="card-text">{{Str::limit($post->description,100)}}</p>
                <a href="#" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
@empty
<div class="col-md-12 text-center">
    No Record Found
</div>
@endforelse