<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script>
		function formValidation(){
			var user = document.form1.username.value;
			var reg = /^([A-Za-z0-9_])$/;
			if(!user.match(reg)); 
				alert('Invalid username');
				return false;
			}
			return true;
		}		
	</script>

<h3>Creating html form</h3> 


<p> login</p>

	<form name = "form1" onsubmit="return formValidation() " action="process.php" method="POST" >
<!-- 	Order matters, first JS script run then the next php page visited -->
 		Username: <input type="text" name="username" placeholder="Enter" value="" > <br><br>		
		<input type="submit" name="button" value="Click here">

	</form>




</body>
</html>
