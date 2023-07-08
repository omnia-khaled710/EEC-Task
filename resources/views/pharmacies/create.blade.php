@extends('layouts.index');
@section('title','Create Pharmacy');
@section('content')
<div class="col-12">
    @if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @elseif (session('erorr'))
    <div class="alert alert-danger">
        {{session('erorr')}}
    </div>
    @endif

</div>
<div class="col-12">

    <form action="{{route('pharmacies.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6 mb-3" >
                <label for="name">Name</label>

                <input type="text" class="form-control" name="name" placeholder="Enter name">
                @error('name')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter address">
                @error('address')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>
            <div class="col-12">
                <button class="btn btn-info w-50 ml-auto ">Create</button>
            </div>
        </div>

    </form>
</div>
@endsection

