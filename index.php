<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script>
		function formValidation(){
 			var user = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var userValid = /^[a-zA-Z0-9]{5,10}$/;
                // username must be between 5 to 10 characters and shouldn't contain special characters
            var passwordValid = /^[\S\s]{8,18}$/;
                //password must be atleast 8 characters
            
			if(!user.match(userValid)){
				alert('Invalid username. Username must be between 5 to 10 characters and shouldnt contain special characters');
				return false;
			}
			if(!password.match(passwordValid)){
				alert('Invalid password. Password must be atleast 8 characters');
				return false;
			}

			return true;
        }
	</script>

<h3>Register New User</h3> 




	<form name = "form1" onsubmit="return formValidation() " action="process.php" method="POST" >
<!-- 	  Order matters, first JS script run then the next php page visited -->
 		Username:<input type="text" id="username" placeholder="Enter" value="" name="username"> <br>	
        Email ID:<input type="text" name= "email"><br>
        Password: <input type="password" id="password" ><br>
        Confirm Password: <input type="password" id="password" ><br>
		         <input type="submit" name="button" value="Click here">

	</form>




</body>
</html>