<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
        body{
            background-color: rgb(250,245,245);
        }
        form{
            border:2px solid transparent;
            background-color: white;
            padding:2rem;
            width: 24rem;
            box-shadow: 0cm 0cm 0.5cm grey;
            margin-left: 15rem;
        }
        .iyyah{
            border-radius: 2rem;
            padding: 10px;
            width: 22rem;
            border: solid transparent;
            background-color:rgb(245,235,235);
        }
        .btn{
            width:10em;
            padding: 10px;
            border-radius: 2rem;
            border: solid transparent;
            background-color: blue;
            margin-left: 116px;

        }
        .papy{
            border-radius: 2rem;
            padding: 10px;
            width: 25rem;
            background-color: white;
        }
        </style>
</head>
<body>
    <form action="sign 2.php" method="post">
        <h1><b>sign in</b></h1>
        <p>new user?<a href="www.google account.com">create an account</a></p>
        <input class=" iyyah"type="email" name="email" placeholder="email address"><br><br>
        <input class ="iyyah"type="password"name="password" placeholder="password"><br><br><br>
        <a href="forget password">forget password</a>
        <input class="btn" name="send" type="submit" value="sign in"><br><br>
        <hr><br>
        <input class="papy"type="submit"value="sign in with Google"><br><br>
        <input class="papy"type="submit"value="sign in with facebook"><br><br>
        <input class="papy"type="submit"value="sign in with Apple"><br><br>
    </form>
    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'erickson');

        if (isset($_POST['email']) && isset($_POST['password']) ){
            $email=$_POST['email'];
            $password=$_POST['password'];

            $insertdata="INSERT INTO personal_info(email,password) VALUES('$email', '$password')";
            $results=mysqli_query($conn,$insertdata);

            if($results){
                echo "Accepted";
            }else{
                echo "Denied";
            }
        }

    ?>
</body>
</html>