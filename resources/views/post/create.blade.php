@extends('layouts.app',['title'=>$title])
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-autox">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <div class="card-body">
                    <form class="form-signin" method="POST" action="{{$action}}" enctypxe="multipart/form-data">
                        @csrf
                        @if ($item)
                        @method('put')
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{$item?$item->name:(old('name')??'')}}" placeholder="Enter name">
                            @error('name')
                                <small class="form-text text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @if($item)
                                <option value="{{$item->category_id}}" selected hidden>{{$item->category->name}}</option>
                                @else
                                <option value="">--select--</option>
                                @endif
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="form-text text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="description" class="form-control" id="description" name="description" rows="10">{{$item?$item->description:(old('description')??'')}}</textarea>
                            @error('description')
                                <small class="form-text text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="images">Upload Images</label>
                            <input type="file" name="images[]" id="images" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" class="dropify" multiple >
                            @error('images')
                                <small class="form-text text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" type="checkbox" name="status" id="status" value="1"  {{ ( ($item&&($item->status==1)) || (old('status')&&(old('status')==1)) ) ? 'checked' : '' }}> Enable
                        </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
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
