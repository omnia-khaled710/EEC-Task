@extends('layouts.index')

@section('content')
    <h1 class="m-3">Search for "{{ $query }}"</h1>
    @if ($products->count())
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

               <td> <a href="{{route('products.show',$product->id)}}">{{$product->title}}</a></td>
                <td>{{$product->description}}</td>
                <td>{{$product->image}}</td>
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
    @else
        <p>No products found.</p>
    @endif
@endsection
