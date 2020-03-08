@extends('user.index')


@section('yourCart')

@foreach($cart as $c) 
	{{$c->name}}
@endforeach

@endsection