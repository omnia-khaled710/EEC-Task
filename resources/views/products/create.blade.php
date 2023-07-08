@extends('layouts.index');
@section('title','Create Product');
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

    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6 mb-3" >
                <label for="Title">Title</label>

                <input type="text" class="form-control" name="title" placeholder="Enter Title">
                @error('title')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>
            <div class="col-6 mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter description">
                @error('description')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>

            <div class="col-6 mb-3">
                <label for="quantity">Quantity </label>
                <input type="number" name="quantity" class="form-control"  placeholder="Enter quantity">
                @error('quantity')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control"  placeholder="Enter price">
                @error('price')
                <div class="text-danger font-weight-bold">*{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pharmacies">Pharmacies</label><br>
                @foreach($pharmacies as $pharmacy)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="pharmacies[]" value="{{ $pharmacy->id }}">
                        <label class="form-check-label" for="pharmacies">{{ $pharmacy->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="file">
                        <img src="{{asset('images/upload.png')}}" id="image"style='cursor:pointer'>
                    </label>
                    <input type="file" name="image" id="file" onchange="loadFile(event)" class= "d-none" >
                    @error('image')
                    <div class="text-danger font-weight-bold">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-info w-50 ml-auto ">Create</button>
            </div>
        </div>

    </form>
</div>
@endsection
@section('js')
<script>
    var loadFile = function(event) {
      var output = document.getElementById('image');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function(){
        URL.revokeObjectURL(output.src) // free memory
      }
    };
  </script>
  @endsection

