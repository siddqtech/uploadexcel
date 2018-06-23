<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Excel Demo</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="excel" style="padding-top: 20px ">
	<div class="container">
		<div class="row" style="background: grey;
    padding: 21px;">
			<div class="col-sm-12">
				@if(Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success')}}</div>
				@endif
				@if(Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error')}}</div>
				@endif
				@if ($errors->any())
				            @foreach ($errors->all() as $error)
				    <div class="alert alert-danger">     {{ $error }}</div>
				            @endforeach
				@endif
	<form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('import')}}">
	{{csrf_field()}}
	<div class="form-group">
    <label class="control-label col-sm-2" for="email">file:</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" id="name" name="excel" placeholder="Enter 
      Name">
    </div>
  </div>
  
  
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
      <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">export</button>
    </div>
  </div>
</form>			
			</div>
		</div>



		<div class="row">
			<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">export data</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" action="{{route('export')}}">
        	{{csrf_field()}}
        	<div class="form-group">
			<label class="sr-only" for="email">Start Date:</label>
			<input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>	
			  </div>
        	<div class="form-group">
			<label class="sr-only" for="email">End Date:</label>
			<input class="form-control" id="date" name="date2" placeholder="MM/DD/YYYY" type="text"/>	
			  </div>
			  <input type="submit" class="btn btn-primary" value="Export">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
			<div class="col-sm-12">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                
            </tr>
        </thead>
        <tbody>
        	@foreach($data as $val)
            <tr>
                <td>{{$val->name}}</td>
                <td>{{$val->email}}</td>
                <td>{{$val->phone}}</td>
                
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
               
            </tr>
        </tfoot>
    </table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src='https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js'></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>	
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
	$(document).ready(function(){
		var date_input=$('input[name="date2"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>

</body>
</html>