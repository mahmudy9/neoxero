@extends('admin.layout')

@section('content')

<h3>Edit Company {{$company->name}}</h3>

@include('errors')
@include('status')
<form action="{{url('/admin/company/'.$company->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">
            Name
        </label>
        <input type="text" class="form-control" value="{{$company->name}}" name="name" />
    </div>

    <div class="form-group">
        <label for="email">
            Email
        </label>
        <input type="email" class="form-control" value="{{$company->email}}" name="email" />
    </div>
    <div class="form-group">
        <label for="website">
            Website
        </label>
        <input type="text" class="form-control" value="{{$company->website}}" name="website" />
    </div>
    <div class="form-group">
        <label for="logo">
            Logo
        </label>
        <input type="file" class="form-control" name="logo" />
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Company" />
    </div>
</form>


@endsection
