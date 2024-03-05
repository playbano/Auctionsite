<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="LoginForm">



    <!-- LOGIN PUTIN        -->
    <form method="post" action="../controller/controller.php">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>  






<!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
            <input class="RememberMe" type="checkbox" value="" id="RememberMe" checked />
            <label class="RememberMe" for="RememberMe"> Remember me </label>
        </div>
        </div>
        <div class="col">
        <!-- Simple link -->
        <a href="#!">Forgot password?</a>
        </div>
    </div>
    <!-- Register buttons -->
    <div class="text-center">
        <p>Not a member? <a href="#!">Register</a></p>
    </div>
    </div> 
           
</body>
</html>