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


<div class="col-12">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">Description</th>

          </tr>
        </thead>
        <tbody>


          <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
          </tr>
        </tbody>
      </table>
</div>
<div class="col-12">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pharmacy</th>
            <th scope="col">Address</th>
            <th scope="col">Price</th>

          </tr>
        </thead>
        <tbody>

            @foreach ($product->pharmacies as $pharmacy)
            <tr>
                <th scope="row">{{$pharmacy->id}}</th>
                <td>{{ $pharmacy->name }}</td>
                <td>{{ $pharmacy->address }}</td>
                <td>{{ $pharmacy->pivot->price }}</td>

            </tr>
        @endforeach

        </tbody>
      </table>
</div>
@endsection
