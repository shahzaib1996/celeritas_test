@extends('layouts.app',['title'=>$title])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-autox">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <div class="card-body">
                    <form class="form-signin" method="POST" action="{{ $item?route('category.update',['category'=>$item->id]):route('category.store') }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{$item?$item->name:(old('name')??'')}}" placeholder="Enter name">
                            @error('name')
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
