<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <script src="scripts/jquery-3.4.0.min.js"></script>
        <script src="scripts/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height:100vh">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="login-check.php" method="post" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <button type="sumbit" id="sendlogin" class="btn btn-primary">login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
