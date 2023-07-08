@extends('layouts.index');
@section('title','Products');
@section('content')

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
<form action="{{route('products.search')}}">
    <div class="input-group mb-3">
        <input type="text" name="query" class="form-control" placeholder="Search" aria-label="Search"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="input-group-text" id="search-btn">Search</button>
        </div>
    </div>
</form>

<div class="col-12">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)

          <tr>
             <th scope="row">{{$product->id}}</th>

           <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td><img width="200px" height="200px" src="{{asset('images/'.$product->image)}}" alt="Product Image"></td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->price}}</td>

            <td>
                <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning">Update</a>
            </td>
                <td>
                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                           @csrf
                           @method('DELETE')
                         <button class="btn btn-danger">Delete</button>
                             </form>
                </td>

          </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
