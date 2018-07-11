@extends('template.template')

@section('body')
	<div class="col-sm-12">
        <form action="{{ route('post-create-ticket') }}" method="POST">
        	@include('ticket._form')
        	<button class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection