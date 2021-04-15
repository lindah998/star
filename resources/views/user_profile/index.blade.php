@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="sm:grid grid-cols-2 gap-20 m-auto">
	<div>
		
	<img src="/background/images.jpeg" width="100" class="pt-4 pb-4">
	<span class="m-auto hover:text-gray-600 text-blue-600 text-l">
		<a href="">Change profile picture</a>
	</span>
</div>
	<div>
		<label class="block pb-4">Name: {{Auth::user()->name}}</label>
		<label class="block pb-4">Email: {{Auth::user()->email}}</label>
		<label class="block pb-4">Date of birth: </label>
		<label class="block pb-4">Address: </label>
		<span class="float-right pt-4">
		<a href="" class="text-l text-blue-600 hover:text-gray-600">Edit Profile</a>
	</span>
	<span class="float-right pt-4 pr-4">
		<a href="" class="text-l text-red-600 hover:text-gray-600">Delete Profile</a>
	</span>
	</div>
	
</div>
@endif

	@endsection