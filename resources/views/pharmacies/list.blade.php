@extends('layouts.index');
@section('title','Pharmacies');
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
<div class="col-12">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($pharmacies as $pharmacy)

          <tr>
             <th scope="row">{{$pharmacy->id}}</th>

            <td>{{$pharmacy->name}}</td>
            <td>{{$pharmacy->address}}</td>
            <td>
                <a href="{{route('pharmacies.edit',$pharmacy->id)}}" class="btn btn-warning">Update</a>
            </td>
                <td>
                        <form action="{{route('pharmacies.destroy',$pharmacy->id)}}" method="post">
                           @csrf
                           @method('DELETE')
                         <button class="btn btn-danger">Delete</button>
                             </form>
                </td>

          </tr>
          @endforeach
        </tbody>
      </table>
      {{$pharmacies->links()}}
</div>
@endsection
