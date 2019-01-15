@extends('admin.layout')

@section('content')


<h3>Companies</h3>

<br><br>
<h3>Add Company</h3>
@include('errors')
@include('status')
<form action="{{url('/admin/company')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">
            Name
        </label>
        <input type="text" class="form-control" value="{{old('name')}}" name="name" />
    </div>

    <div class="form-group">
        <label for="email">
            Email
        </label>
        <input type="email" class="form-control" value="{{old('email')}}" name="email" />
    </div>
    <div class="form-group">
        <label for="website">
            Website
        </label>
        <input type="text" class="form-control" value="{{old('website')}}" name="website" />
    </div>
    <div class="form-group">
        <label for="logo">
            Logo
        </label>
        <input type="file" class="form-control" name="logo" />
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add Company" />
    </div>
</form>

<br><hr>
<table class="table">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Logo</td>
        <td>Website</td>
        <td>Created At</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    @foreach($companies as $c)
    <tr>
        <td>{{$c->id}}</td>
        <td>{{$c->name}}</td>
        <td>{{$c->email}}</td>
        <td><img src="{{url('/storage/'.$c->logo)}}" width="100px" height="100px" /></td>
        <td>{{$c->website}}</td>
        <td>{{$c->created_at}} </td>
        <td><a href="{{url('/admin/company/'.$c->id.'/edit')}}" class="btn btn-info" >Edit</a> </td>
        <td><button onclick="event.preventDefault();
        document.getElementById('form').submit();" class="btn btn-danger" >Delete</button> </td>
        <form id="form" style="display:none" action="{{url('/admin/company/'.$c->id)}}" method="post">@csrf @method('delete')</form>
    </tr>
    @endforeach
</table>

@endsection
