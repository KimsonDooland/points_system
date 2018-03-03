@extends('layouts.app')
@section('content')


@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if (Session::has('error_txt'))
   <div class="alert alert-success">{{ Session::get('error_txt') }}</div>
@endif


<div class="container">
  <form method="post" action="{{url('/show_reference')}}">
    <div class="form-group row">
      {{csrf_field()}}
      <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Phone Number to Refer</label>
      <div class="col-sm-10">
        <input type="number" class="form-control form-control-lg" id="name" placeholder="Phone Number" name="phone_number" required>
      </div>
    </div>

  
   
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>

@endsection