@extends('admin.layout')

@section('content')


<h3>Employees</h3>

<br><br>
<h3>Add Employee</h3>
@include('errors')
@include('status')

<form action="{{url('/admin/employee')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="first_name">
           First Name
        </label>
        <input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" />
    </div>

    <div class="form-group">
        <label for="last_name">
           Last Name
        </label>
        <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" />
    </div>

    <div class="form-group">
        <label for="email">
            Email
        </label>
        <input type="email" class="form-control" value="{{old('email')}}" name="email" />
    </div>
    <div class="form-group">
        <label for="phone">
            Phone
        </label>
        <input type="tel" class="form-control" value="{{old('phone')}}" name="phone" />
    </div>
    <div class="form-group">
        <label for="company">
            Company
        </label>
        <select name="company" class="form-control">
            @foreach($companies as $c)
                <option value="{{$c->id}}" @if($c->id == old('company')) 
                    selected
                    @endif
                    >{{$c->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add Employee" />
    </div>
</form>

<br><hr>
<table class="table">
    <tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Company</td>
        <td>Created At</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    @foreach($employees as $e)
    <tr>
        <td>{{$e->id}}</td>
        <td>{{$e->first_name}}</td>
        <td>{{$e->last_name}}</td>
        <td>{{$e->email}}</td>
        <td>{{$e->phone}}</td>
        <td>{{$e->company->name}}</td>
        <td>{{$e->created_at}} </td>
        <td><a href="{{url('/admin/employee/'.$e->id.'/edit')}}" class="btn btn-info" >Edit</a> </td>
        <td><button onclick="event.preventDefault();
        document.getElementById('form').submit();" class="btn btn-danger" >Delete</button> </td>
        <form id="form" style="display:none" action="{{url('/admin/employee/'.$e->id)}}" method="post">@csrf @method('delete')</form>

    </tr>
    @endforeach
</table>

@endsection
