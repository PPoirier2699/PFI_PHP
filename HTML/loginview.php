<?php
   if(isset($_GET['ErrorMSG'])){
		$error = $_GET['ErrorMSG'];  
		echo "<script>alert('$error');</script>";
   }
?>
<div class="row border p-4" style="display: inline-block; border-radius: 15px;">

	<form action="DOMAINLOGIC/login.dom.php" method="post">

	<div class="col-sm">
		<h2 style="text-align: center;">Login</h2> <br>
        <div class="form-group col">
            <label for="email">Email:</label>
            <input  class="form-control" id="email" name="email">	
        </div>
        <div class="form-group col">
            <label>Password:</label>
            <input type="password" class="form-control" id="pw" name="pw">
        </div>	
        <br>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
	</div>

	</form>

</div>