<html>
<head>
	<title>Laravel Project</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery-ui/jquery-ui.css') }}">
	<script type="text/javascript" src="{{ asset('assets/jquery/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/jquery-ui/jquery-ui.js') }}"></script>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/') }}">L Project</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="active"><a href="{{ url('/create') }}">Add Employee</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<form method="POST" enctype="multipart/form-data" id="employeeForm">
			<div class="form-group">
				<label for="firstName">First Name:</label>
				<input type="text" class="form-control" id="firstName" name="firstName">
				@csrf
			</div>
			<div class="form-group">
				<label for="lastName">First Name:</label>
				<input type="text" class="form-control" id="lastName" name="lastName">
			</div>
			<div class="form-group">
				<label for="gender">Gender:</label>
				<label class="radio-inline"><input type="radio" name="gender" id="gender" value="Male">Male</label>
				<label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
			</div>
			<div class="form-group">
				<label for="dateOfBirth">Date Of Birth:</label>
				<input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email">
			</div>
			<div class="form-group">
				<label for="phone">Phone:</label>
				<input type="text" class="form-control" id="phone" name="phone">
			</div>
			<div class="form-group">
				<label for="languages">Languages:</label>
				<label class="checkbox-inline"><input type="checkbox" value="C" name="languages[]" id="languages">C</label>
				<label class="checkbox-inline"><input type="checkbox" value="PHP" name="languages[]">PHP</label>
				<label class="checkbox-inline"><input type="checkbox" value="JavaScript" name="languages[]">JavaScript</label>
			</div>
			<div class="form-group">
				<label for="photo">Photo:</label>
				<input type="file" class="form-control" id="photo" name="photo">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#dateOfBirth").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});

		$("#employeeForm").submit(function (e) {
			e.preventDefault();
			let formData = new FormData(this);
			$.ajax({
				url: "{{ url('/store') }}",
				data: formData,
				type: 'POST',
				dataType: 'json',
				cache: false,
				processData: false,
				contentType: false,
				success: function (res) {
					if (res.status == 'success') {
						window.location.replace("{{ url('/') }}");
					} else {
						console.log(res);
					}
		        },
		        error: function (err) {
		        	console.log(err);
		        }
		    });
		});
	});
</script>
</html>