@extends('template.template')

@section('body')
	<div class="col-sm-12">
        <form action="{{ route('post-import-tickets') }}" method="POST" enctype="multipart/form-data">
        	@csrf
        	<div class="form-group">
        		<label>Fichier :</label>
        		<input type="file" name="csv_file" required>
        	</div>
        	<button class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection