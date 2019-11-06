@extends('layouts.app')

@section('posts')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="container-fluid text-center my-3 p-3 bg-white rounded shadow-sm">
    <h1>Laravel Guestbook</h1>
    <posts-component :posts="{{$posts}}"></posts-component>
</div>
@endsection
