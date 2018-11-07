<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
		<meta name="author" content="Jelena Juras">
		<meta name="description" content="">
		
		<!-- Bootstrap - Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<!-- Side dropdown -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		@stack('stylesheet')
		<!-- Awesome icon -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}" type="text/css" >
   </head>
<style>
	
</style>
</head>
<body>

	<div class="sidenav">
		<a class="navbar-brand" href="{{ route('admin.dashboard') }}" id="duplico">Duplico</a>
		<!-- Vidi samo administrator -->
		@if (Sentinel::check() && Sentinel::inRole('administrator'))
		<button class="dropdown-btn">Opći podaci 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a class="{{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Korisnici</a>
			<a class="{{ Request::is('admin/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Dozvole</a>
			<a class="{{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Kategorije</a>
		</div>
		@endif
		<!-- Vidi basic -->
		
		<button class="dropdown-btn">Poruke
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a class="{{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">Poruke</a>
		</div>

		<button class="dropdown-btn">...
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a class="" href="">...</a>
			<a href="">...</a>
			<a href="">...</a>
		</div>
	</div>
	<nav class="navbar navbar-inverse">	
		<div class="container-fluid">
			@if (Sentinel::check())
			<form class="navbar-form navbar-left" action="/action_page.php" id="center">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Traži na stranici..." name="search" id="myInput">
				</div>		
			</form>
			@endif	
			<div class="navbar-header navbar-right" id="nav-right" >
				@if (Sentinel::check())
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="nav-right"><span class="user"></span> {{ Sentinel::getUser()->first_name }} <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="{{ route('auth.logout') }}" id="font12">Odjava</a></li>
					</ul>
				</li>
				@else
					<li><a href="{{ route('auth.login.form') }}">Prijava</a></li>
					<li><a href="{{ route('auth.register.form') }}">Registracija</a></li>
				@endif				
			</div>
			
		</div>
	</nav>
	<div class="main">
	@include('notifications')
		@yield('content')
	</div>
	<script>
		/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;
		for (i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") {
		  dropdownContent.style.display = "none";
		} else {
		  dropdownContent.style.display = "block";
		}
		});
		}
	</script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
	<script src="{{ asset('js/restfulizer.js') }}"></script>
	
	
	<!-- DataTables -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.css"/>
 
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.js"></script>

		<script>
			$(document).ready(function() {
				var table = $('#table_id').DataTable( {
					"paging": true,
					language: {
						paginate: {
							previous: 'Prethodna',
							next:     'Slijedeća',
						},
						"info": "Prikaz _START_ do _END_ od _TOTAL_ zapisa",
						"search": "Filtriraj:",
						"lengthMenu": "Prikaži _MENU_ zapisa"
					},
					 "lengthMenu": [ 25, 50, 75, 100 ],
					 "pageLength": 50,
					 dom: 'Bfrtip',
						buttons: [
							'copy', 'print',
						{
						extend: 'pdfHtml5',
						text: 'Izradi PDF',
						exportOptions: {
							columns: ":not(.not-export-column)"
							}
						},
						{
						extend: 'excelHtml5',
						text: 'Izradi XLS',
						exportOptions: {
							columns: ":not(.not-export-column)"
						}
						},
						],
				} );
				$('a.toggle-vis').on( 'click', function (e) {
					e.preventDefault();
			 
					// Get the column API object
					var column = table.column( $(this).attr('data-column') );
			 
					// Toggle the visibility
					column.visible( ! column.visible() );
				} );
			} );
		</script>	
	@stack('script')
</body>
</html>
