<?php
session_start();

include '../../autoloader.php';
include '../../ConnectionDb.php';
$db = new ConnectionDb();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    $sql = "SELECT * FROM usert WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['username'] = $user['userName'];
            header('Location: index.php');
            exit();
    } else {
        // wrong email or password
        $error ="Wrong login credentials!";
        echo "Wrong login credentials! Echo!";
    }

    } else {
        // hittar inte email
        $error ="Couldnt find user, wrong email?";
        echo "Couldnt find user, wrong email? echo";
    }
}
?>