<html>
<head>
	<title>Laravel Project</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/custom/custom.css') }}">
	<script type="text/javascript" src="{{ asset('assets/jquery/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/DataTables/datatables.js') }}"></script>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/') }}">L Project</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/create') }}">Add Employee</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sr</th>
					<th>Photo</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Date Of Birth</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Languages</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</body>
<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="panel panel-primary">
					<div class="panel-heading">Edit Employee</div>
					<div class="panel-body">
						<form method="POST" enctype="multipart/form-data" id="employeeForm">
							<div class="form-group">
								<label for="firstName">First Name:</label>
								<input type="text" class="form-control" id="firstName" name="firstName">
								<input type="hidden" name="id">
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
								<input type="text" class="form-control wid" id="dateOfBirth" name="dateOfBirth">
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
								<label for="photo" class="col-md-12">Photo:</label>
								<input type="file" class="form-control wid col-md-6" id="photo" name="photo">
								<div class="img col-md-6">
									
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger">
					<div class="panel-heading">Delete Employee</div>
					<div class="panel-body">
						<form id="deleteForm" method="POST">
							<input type="hidden" name="delId">
							@csrf
							<h2>Are you sure to delete employee ?</h2>
							<button type="submit" class="btn btn-danger">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$(".table").DataTable({
			"ajax": "{{ url('/employees') }}",
			"columns": [
			{ "data": "id" },
			{ "data": function (item, index) { 
				let path = '{{ asset("/") }}';
				return '<img src="'+path+'storage/'+item.photo+'" height="50px" width="50px">' 
			} },
			{ "data": "firstName" },
			{ "data": "lastName" },
			{ "data": "gender" },
			{ "data": "dateOfBirth" },
			{ "data": "email" },
			{ "data": "phone" },
			{ "data": "languages" },
			{ "data": function (item, index) { return '<a class="btn btn-warning" onclick="editEmployee('+item.id+')">Edit</a><a class="btn btn-danger" onclick="deleteEmployee('+item.id+')">Delete</a>' } },
			]
		});

		$("#employeeForm").submit(function (e) {
			e.preventDefault();
			let formData = new FormData(this);
			$.ajax({
				url: "{{ url('/update') }}",
				data: formData,
				type: 'POST',
				dataType: 'json',
				cache: false,
				processData: false,
				contentType: false,
				success: function (res) {
					if (res.status == 'success') {
						window.location.reload();
					} else {
						console.log(res);
					}
		        },
		        error: function (err) {
		        	console.log(err);
		        }
		    });
		});

		$("#deleteForm").submit(function (e) {
			e.preventDefault();
			let formData = new FormData(this);
			$.ajax({
				url: "{{ url('/destroy') }}",
				data: formData,
				type: 'POST',
				dataType: 'json',
				cache: false,
				processData: false,
				contentType: false,
				success: function (res) {
					if (res.status == 'success') {
						window.location.reload();
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

	function editEmployee(obj) {
		$("input[name=id]").val(obj);
		$("#editModal").modal('toggle');
		let data = {
			id : obj,
			"_token" : "{{ csrf_token() }}",
		}
		$.ajax({
			url: "{{ url('/edit') }}",
			data: data,
			type: 'POST',
			dataType: 'json',
			success: function (res) {
				if (res.status == 'success') {
					let data = res.data;
					let path = '{{ asset("/") }}';
					let lang = data.languages.split(", ");
					$("#firstName").val(data.firstName);
					$("#lastName").val(data.lastName);
					$("input[value="+data.gender+"]").prop("checked", true);
					$("#dateOfBirth").val(data.dateOfBirth);
					$("#email").val(data.email);
					$("#phone").val(data.phone);
					lang.forEach(function (item, index) {
						$("input[value="+item+"]").prop("checked", true);
					})
					$(".img").append('<img class="profile" src="'+path+'storage/'+data.photo+'" height="50px" width="50px">');
				} else {
					console.log(res);
				}
	        },
	        error: function (err) {
	        	console.log(err);
	        }
	    });
	}

	function deleteEmployee(obj) {
		$("input[name=delId]").val(obj);
		$("#deleteModal").modal('toggle');	
	}
</script>
</html>