<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login As</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
		
		.login-container {
			background-color: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
            padding: 30px; /* Increased padding to make the form slightly larger */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;
		}
		
		.logo {
			width: 100px;
			margin: 20px auto;
			display: block;
		}
		
		
		.btn {
			margin-bottom: 10px;
		}
		
		.btn-primary {
			font-size: large;
            background-color: #24ce48;
            border-color: #24ce48;
            color: #fff;
        }
		
		.btn-secondary {
			font-size: large;
			background-color: #000000;
			border-color: #000000;
		}
		.btn:hover {
			background-color: #04614C;
		}
        .imgbck  {
			background-color: lightgray;
		}
	</style>
</head>
<body>
    <img src=" " style="position: absolute; top: 0; left: 0; width: 100%; height: 100vh; object-fit: cover; z-index: -1;"class="imgbck"> 
	<div class="container">
		<div class="row justify-content-center align-items-center" style="height: 100vh">
			<div class="col-md-6">
				<div class="login-container">
					<img src="img/ptci.png" alt="Logo" class="logo">
					<h2 class="text-center">Login</h2>
					<form>
                    <a><hr class="divider" /></a>
						<div class="form-group">
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<!--button type="submit" class="btn btn-primary btn-block">Login</button real code to submit--> 
						<a href="admin/dashboard.php" class="btn btn-primary btn-block">Login</a><!--for demo only-->
                        <a><hr class="divider" /></a>
                        <a href="javascript:history.back()" class="btn btn-secondary btn-block">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>