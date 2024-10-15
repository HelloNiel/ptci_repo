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
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.login-container {
			background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 50%;
		}
		.logo {
			width: 100px;
			margin: 20px auto;
			display: block;
		}
		.text-center {
			margin-top: 0;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		.btn {
			margin-bottom: 10px;
		}
		.btn-primary {
			background-color: #24ce48;
			border-color: #24ce48;
			color: #fff;
		}
		.btn-secondary {
			background-color: #000000;
			border-color: #000000;
		}
		.btn:hover {
			background-color: #04614C;
		}
	</style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <img src="img/ptci.png" alt="Logo" class="logo">
            <h2 class="text-center">Login</h2>
            <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }
            ?>
            <form action="jdg_login_function.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <a href="javascript:history.back()" class="btn btn-secondary btn-block">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
