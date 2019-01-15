@extends('admin.layout')

@section('content')


<h3>Edit Employee {{$employee->first_name . ' ' . $employee->last_name}}</h3>

@include('errors')
@include('status')

<form action="{{url('/admin/employee/'.$employee->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="first_name">
           First Name
        </label>
        <input type="text" class="form-control" value="{{$employee->first_name}}" name="first_name" />
    </div>

    <div class="form-group">
        <label for="last_name">
           Last Name
        </label>
        <input type="text" class="form-control" value="{{$employee->last_name}}" name="last_name" />
    </div>

    <div class="form-group">
        <label for="email">
            Email
        </label>
        <input type="email" class="form-control" value="{{$employee->email}}" name="email" />
    </div>
    <div class="form-group">
        <label for="phone">
            Phone
        </label>
        <input type="tel" class="form-control" value="{{$employee->phone}}" name="phone" />
    </div>
    <div class="form-group">
        <label for="company">
            Company
        </label>
        <select name="company" class="form-control">
            @foreach($companies as $c)
                <option value="{{$c->id}}" @if($c->id == $employee->company_id) 
                    selected
                    @endif
                    >{{$c->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Employee" />
    </div>
</form>

@endsection
