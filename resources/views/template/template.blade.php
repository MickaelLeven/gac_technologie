<html>
<head>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	 <link  rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
	 <link  rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-grid.min.css') }}"/>
	 <link  rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}"/>
</head>

<body>
	<div class="container">
		<div class="row">
			@yield('body')
		</div>
	</div>
</body>

<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@yield('scripts')

</html>