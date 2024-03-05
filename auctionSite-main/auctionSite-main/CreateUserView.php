
<?php
session_start(); 

include 'autoloader.php';
require('header.php');

$db = new ConnectionDb();
$connection = $db->getConnection();

$userName = "";
$password = "";
$balance = "";
$email = "";
$birthDate = "";
$buyer = "";
$seller = "";

?>
<link rel="stylesheet" href="style.css">
<body>

    <form action = "Controller/CreateUserController.php" method = "post">
        <div class="form-group">
            <label for="name">User name</label>  
                <input type = "text" class="form-control" name = "userName" value = "<?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>"><br>
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type = "password" class="form-control" name = "password" id="password"><br>
        </div>
        
        <div class="form-group">
            <label for="name">Email</label>  
                <input type = "email" class="form-control" name = "email" value = "<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"><br>
        </div>

        <div class="form-group">
            <label for="name">BirthDate</label>  
                <input type = "date" class="form-control" name = "birthDate" value = "<?php echo htmlspecialchars($birthDate, ENT_QUOTES, 'UTF-8'); ?>"><br>
        </div>


        <div class="form-group">
            <input type = "checkbox" name = "buyer" value = "ok"<?php if($buyer==="ok"){echo ' checked';} ?>>
            <label for="buyer">Buyer<br></label>
        
        </div>
        <div class="form-group">
            <input type = "checkbox" name = "seller" value = "ok"<?php if($seller==="ok"){echo ' checked';} ?>>
            <label for="seller">Seller<br></label>
        
        </div>
        <div class="form-group">
            <input type = "number" name = "balance" value = "<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"><br>
            <label for="seller">Balance<br></label>
        
        </div>

        <input type = "submit" name = "submit" value = "Register">
    
    </form>

</body>



<style>


</style>