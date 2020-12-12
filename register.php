<?php

$errors = [];

$firstname = '';
$lastname = '';
$email = '';
$password = '';
$confirmPassword = '';

/*
Firstname string
Lastname string
Email should be email
Password should be more than 8 max 35
Confirm shoud be the same as password
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$firstname = sanitize($_POST['firstname']) ?? '';
	$lastname = sanitize($_POST['lastname']) ?? '';
	$email = sanitize($_POST['email']) ?? '';
	$password = sanitize($_POST['password']) ?? '';
	$confirmPassword = sanitize($_POST['confirmPassword']) ?? '';

	if (empty($firstname)) {
		$errors['firstname'] = 'First name is required';
	} else if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
		$errors['firstname'] = "Only letters and white space allowed";
	}
	if (empty($lastname)) {
		$errors['lastname'] = 'Last name is required';
	} else if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
		$errors['lastname'] = "Only letters and white space allowed";
	}
	if (empty($email)) {
		$errors['email'] = 'Email is required';
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Email must be valid';
	}
	if (empty($password)) {
		$errors['password'] = 'Password is required';
	} else if (strlen($password) < 8 || strlen($password) > 35) {
		$errors['password'] = 'Password should have between 8 and 20 characters';
	}

	if (empty($confirmPassword)) {
		$errors['confirmPassword'] = 'Confirmation of password is required';
	}
	if ($password && $confirmPassword && strcmp($password, $confirmPassword) !== 0) {
		$errors['confirmPassword'] = 'Your password must match the password you created first';
	}
	if (empty($errors)) {
		redirect("signIn.php?logged=0");
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
    <title>Sign_up</title>
  </head>
  <body>
    
  <div class="container">
		 	<div class="row justify-content-center" style="margin-top: 25px">
				<div class="col-11 mx-auto col-sm-6">
					<div class="card">
						<div class="card-body">
							<h1 class="text-center text">Sign up</h1>
							<form action="<?php echo sanitize($_SERVER['PHP_SELF']); ?>" method="post">
								<div class="row justify-content-center">
									<div class="col-6">
										<div class="form-group">
											<label class="text" for="firstname">Firstname</label>
											<input type="text" name="firstname"
											class="form-control <?php echo isset($errors['firstname']) ? 'is-invalid' : '' ?>" >
											<div class="invalid-feedback">
												<?php echo $errors['firstname'] ?? '' ?>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="form-group">
											<label class="text" for="lastname">Lastname</label>
											<input type="text"  name="lastname" class="form-control <?php echo isset($errors['lastname']) ? 'is-invalid' : '' ?>">
											<div class="invalid-feedback">
												<?php echo $errors['lastname'] ?? '' ?>
											</div>
										</div>
									</div>
								</div>
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
									<input type="password"
									class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : '' ?>"
									id="exampleInputPassword1" name="password">
									<div class="invalid-feedback">
										<?php echo $errors['password'] ?? '' ?>
									</div>
								</div>
								<div class="form-group">
									<label class="text" for="exampleInputPassword1">Confirm Password</label>
									<input type="password"
									class="form-control <?php echo isset($errors['confirmPassword']) ? 'is-invalid' : '' ?>"
									id="exampleInputPassword1" name="confirmPassword">
									<div class="invalid-feedback">
										<?php echo $errors['confirmPassword'] ?? '' ?>
									</div>
								</div>
								<div class="d-grid gap-2 col-6 mx-auto">
								<button type="submit" class="btn Button" name="register">Sign up</button>
								</div>
							</form>
						</div>
						<div class="card-footer">
							<p>Have an account? <a href="signIn.php" class="link-primary">Sing in</a></p>
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