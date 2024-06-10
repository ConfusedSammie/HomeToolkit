<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <?php include('includes/meta_includes.php'); ?>
    <?php include('includes/css_includes.php'); ?>
</head>
<body>
    <div class="login-container login-page">
        <div class="left-pane">
            <img src="images/CatsAndPlantsArt.png" alt="Image">
            <h3>Purr & Plants</h3>
            <p>Your Hub for Happy Plants and Content Cats</p>
        </div>
        <div class="right-pane">
            <div class="alert alert-warning" role="alert">
                <strong>Warning!</strong> These internal tools are private and can only be accessed by authorized users. If you want access, contact Sam Jabbour.
            </div>
            <div class="header">
                <h4>Login below to access the tools</h4>
            </div>
            <form method="post" action="functions/login_process.php">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group" style='margin-top:20px;'>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div style='margin-top:20px;'>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
                

            </form>
        </div>
    </div>
</body>
</html>
