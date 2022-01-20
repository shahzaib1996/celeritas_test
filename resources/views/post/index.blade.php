@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}}</div>
                <div class="card-body">
                    <table class="table" id="listingTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="200px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{Str::limit($item->description,50)}}</td>
                                <td>{{($item->status==1)?'Enable':'Disable'}}</td>
                                <td>
                                    <a href="{{route('post.edit',['post'=>$item->enc_id])}}" class="btn btn-sm btn-info"> Edit </a>
                                    <a href="{{route('post.destroy',['post'=>$item->enc_id])}}" data-method="delete" class="btn btn-sm btn-danger"> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#listingTable').DataTable();
    });
</script>
@endpush
