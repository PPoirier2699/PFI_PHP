<?php
   if(isset($_GET['ErrorMSG'])){
		$error = $_GET['ErrorMSG'];  
		echo "<script>alert('$error');</script>";
   }
?>
<form action="DOMAINLOGIC/register.dom.php" method="post" enctype="multipart/form-data">
	<div class="row border p-4" style="display: inline-block; border-radius: 15px;">	
		<div class="col-sm">
			<h2 style="text-align: center;">Register</h2> <br>
			<div class="row">
				<div class="form-group col">
				<label for="email">Email:</label>
				<input  class="form-control" id="email" name="email">
				</div>
				<div class="form-group col">
				<label>Username:</label>
				<input class="form-control" id="username" name="username">		
				</div>		
			</div>
			<div class="form-group col">
				<label>Password:</label>
				<input type="password" class="form-control" id="pw" name="pw">
			</div>	
			<div class="form-group col">
				<label>Password Validation:</label>
				<input type="password" class="form-control" id="pwValidation" name="pwValidation">
			</div>	
			<br>
			<button type="submit" class="btn btn-primary btn-block">Register</button>
		</div>	
	</div>
	<div class="row border p-4" style="display: inline-block; float: right; height: 40%; border-radius: 15px;">
		<h2 style="text-align: center;">Add a profile picture</h2>
		<input type="file" name="profilePictureURL" id="Media" required>
	</div>
</form>