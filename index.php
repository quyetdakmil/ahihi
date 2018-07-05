<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<head>
		<title>Index</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css" media="screen">
			textarea {
			resize: none;
			}
		</style>
	</head>
	<body>
		<div style="padding-top: 80px;" class="container">
			<form class="form-group" action="sql.php" method="Post">
				<div class="row">
					<div class="col-md-4">
						<textarea rows="7" class="form-control" name="input" style="width: 400px; height: 400px;"></textarea>
					</div>
					<div class="col-md-2">
						<input class="form-control" value="submit" type="submit">
					</div>
					<div class="col-md-6">
						<textarea rows="7" class="form-control" name="output"></textarea>
					</div>
					<div style="padding-top: 80px" class="col-md-offset-4 col-md-4">
						<select class="form-control">
							<option>java</option>
							<option>visual basic</option>
						</select>
					</div>
				</div>
			</form>
		</div>
		<!-- <form action="readFile.php" method="post" accept-charset="utf-8">
			<input type="file" name="file">
			<input type="submit" name="" value="Upload">
		</form> -->

		<!-- <form action="ConnectPostgre.php" method="POST">
			SQL: <textarea name="sqlQuery" style="width: 800px; height: 500px;"></textarea>
			<input type="Submit" name="" value="Check">
		</form> -->
	</body>
</html>