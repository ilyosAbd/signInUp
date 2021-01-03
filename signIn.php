<?php

$errors = [];

$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = sanitize($_POST['email']) ?? '';
	$password = sanitize($_POST['password']) ?? '';

	if (empty($email)) {
		$errors['email'] = 'Email is required';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Email must be valid';
	}
	if (empty($password)) {
		$errors['password'] = 'Password is required';
	} else if (strlen($password) < 8 || strlen($password) > 35) {
		$errors['password'] = 'Password should have between 8 and 35 characters';
	}

	if (empty($errors)) {
		redirect("welcome.php?logged=1");
	}

}

function redirect($url) {
	header("Location: $url");
}

function sanitize($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="signInUp.css">
    <title>Sign_in</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center" style="margin-top: 150px">
	     <div class="col-11 mx-auto col-sm-6">
	        <div class="card">
		        <div class="card-body">
			       <h1 class="text-center text">Sign in</h1>
             <form action="signIn.php" method="post">
								<div class="form-group">
									<label class="text" for="exampleInputEmail1">Email address</label>
									  <input type="text"
									    class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : '' ?>"
									      id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
									        <div class="invalid-feedback">
										        <?php echo $errors['email'] ?? '' ?>
								        	</div>
									          <small id="emailHelp">We'll never share your email with anyone else.</small>
						    </div>
								<div class="form-group">
									<label class="text" for="exampleInputPassword1">Password</label>
									  <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>" id="exampleInputPassword1" name="password">
									    <div class="invalid-feedback">
									     	<?php echo $errors['password'] ?? '' ?>
								    	</div>
                     
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn Button" name="login">Sign in</button>
                    </div>  
                    <div class="card-footer text">
						          	<p>Don't have an account? <a href="register.php" class="link-primary">Sign up</a></p>
						          </div>       
	        </div>
	      </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>
