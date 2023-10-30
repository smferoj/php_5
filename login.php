<?php
session_start();
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$errorMessage = "";

$fp = fopen("./data/users.txt", "r");

$roles = array();
$emails = array();
$passwords = array();

while ($line = fgets($fp)) {
    $values = explode(",", $line);
    array_push($roles, trim($values[0]));
    array_push($emails, trim($values[1]));
    array_push($passwords, trim($values[2]));
}

fclose($fp); 

for($i=0; $i<count($roles); $i++) {
        if($email == $emails[$i] && $password == $passwords[$i]){
            $_SESSION["role"] = $roles[$i];
            $_SESSION["email"] = $emails[$i];
           header("Location: index.php");
        }else{
         $errorMessage = "Wrong username or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-primary text-center">Welcome to Login</h1>

        <form action="login.php" method ="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter your password">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck">
                <label for="exampleCheck" class="form-check-label">Remember Me</label>
            </div>
             
            <p class="text-warning">
             <?php echo $errorMessage;?>
             </p>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
