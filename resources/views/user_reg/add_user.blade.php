@extends('layouts.app')
@section('content')


@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if (Session::has('error_txt'))
   <div class="alert alert-success">{{ Session::get('error_txt') }}</div>
@endif


<div class="container">
  <form method="post" action="{{url('users_create')}}">
    <div class="form-group row">
      {{csrf_field()}}
      <label for="name" class="col-sm-2 col-form-label col-form-label-lg">User Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="name" placeholder="Name" name="name" required>
      </div>
    </div>

     <div class="form-group row">
     <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-control-lg" id="email" placeholder="Email" name="email">
        </div>
    </div>
     <div class="form-group row">
     <label for="address" class="col-sm-2 col-form-label col-form-label-lg">Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control form-control-lg" id="address" placeholder="Address" name="address">
        </div>
    </div>
    <div class="form-group row">
     <label for="phone_number" class="col-sm-2 col-form-label col-form-label-lg">Phone</label>
        <div class="col-sm-10">
          <input type="number" class="form-control form-control-lg" id="phone_number" placeholder="Phone Number" name="phone_number" required>
        </div>
    </div>
   
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>

@endsection