<?php require_once('../template/headerNoLogin.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/signin.css">
    <title>Sign in</title>
</head>

<?php
require_once ('config.php'); // This is where the username and password are currently stored (hardcoded in variables)
require_once '../src/clean.php';
$clean = new clean();


/* Check if login form has been submitted */
/* isset — Determine if a variable is declared and is different than
NULL*/
if(isset($_POST['Submit']))
{
    try{
        $connection = new PDO($dsn, $username, $password, $options);

        $sql ="SELECT firstname, password from users where firstname = :USER";
        $statement =$connection->prepare($sql);
        $tmpUser = ($_POST['Username']);
        $statement->bindParam( ':USER',  $tmpUser, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row => $rows)
        {
            $fname_db = $rows['firstname'];
            $pwd_db = $rows['password'];

            if (($_POST['Username'] == $fname_db) && ($_POST['Password'] == $pwd_db))
            {
                $_SESSION['Username'] = $fname_db;
                $_SESSION['Active'] = true;
                header(  "location:index.php");
                exit;
            }
            else{
                echo 'Incorrect Username or password';
            }

            }
        }
        catch 
        (Exception $e)
        {
            echo '<div class="messages-error">Error Logging In:' . $e->getMessage() . '</div>';
        }
    }

?>

<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" >Username</label>
        <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

    </form>
</div>
</body>
</html>
