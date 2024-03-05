<?php
session_start();
include 'autoloader.php';
require('header.php');
$email = "";

?>
<link rel="stylesheet" href="style.css">
<body>

    <form action = "" method = "post">
        <div class="form-group">
            <label for="name">Email</label>  
                <input type = "text" class="form-control" name = "email" value = "<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"><br>
        </div>

        <input type = "submit" name = "submit" value = "Search">
    </form>

</body>

<?php

    if (isset($_POST['submit'])) 
    {
        $db = new ConnectionDb();
        $email = $_POST['email'];
        $user = new UserDAO($db->getConnection());
        
        //Använder Class UserID
        if($user->Find ($email) != false && ($email) != "")
        {
            $user = $user->Find($email);

            //var_dump($user);
            
            echo "<li>Username: ".$user->getUserName()."</li>";
            echo "<li>Email: ".$user->getEmail();"</li>";
            $_SESSION['user_id'] = $user->getId();
            echo "<li>User ID: ".$_SESSION['user_id']."</li>";

        }
        else{
            echo "<li>User not found</li>";
        }
            
            

    }

?>