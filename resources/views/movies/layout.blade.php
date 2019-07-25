<!DOCTYPE html>
<html lang="en">
	<head>
		<title>IMDb Movie Website Example</title>
	  	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    	<meta name="csrf-token" content="{{ csrf_token() }}" />
		
	</head>

	<body >
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" >Movies</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
				  	<li class="nav-item">
				    	<a class="nav-link" target="blank" href="{{ route('movies.create') }}">Add new</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" href="#">Link</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" href="#">Link</a>
				  	</li>    
				</ul>
			</div>  
		</nav>

		<div class="text-center" style="margin-bottom:0">
			<div class="container pt-5">
				@yield('content')
			</div>
		</div>

		<small>
			<footer class="foot" >
			  	<!-- Copyright -->
			  	<div class="footer-copyright text-center py-3">© 2019 Copyright
			  	</div>
			  	<!-- Copyright -->
			</footer>
		</small>
			
	</body>
</html>

<style>
	.foot{
	   position:absolute;
	   bottom:0!important;
	   width:100%;
	   height: 2.5rem;
	}
</style>