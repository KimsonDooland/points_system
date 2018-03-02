<!-- app/views/nerds/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('nerds') }}">Nerd Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('nerds') }}">View All Nerds</a></li>
        <li><a href="{{ URL::to('nerds/create') }}">Create a Nerd</a>
    </ul>
</nav>

<h1>All the Points</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>USER ID</td>
            <td>POINTS</td>
            <td>PRICE</td>
        </tr>
    </thead>
    <tbody>
    @foreach($points as $point)
        <tr>
            <td>{{ $point->id}}</td>
            <td>{{ $point->user_id}}</td>
            <td>{{ $point->points }}</td>
            <td>{{ $point->price }}</td>

        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>
