<?php session_start();

include '_inc/__fun.php';


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="Content-Security-Policy"
        content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com" />
    <meta content="Source code generated using rand.sy" name="description" />
    <meta content="rand.sy" name="author" />
    <!---------------------------------------------------->
    <link href="./css/ico/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <title>Rand Services</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/font.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12  col-md-12 col-lg-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-12 col-lg-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-12 col-lg-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-12 col-lg-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4   col-md-4  col-lg-4">
            </div>
            <div class="col-sm-4   col-md-4  col-lg-4">
                <form role="form" style="border:thin #1ccce1 solid;border-radius:10px;padding:10px">
                    <div class="form-group text-center">
                        <h2>Services Interface</h2>
                    </div>
                    <div class="form-group">
                        <label for="smstxt"><span class="glyphicon glyphicon-user">&nbsp;</span>Username </label>
                        <input id="uss" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pss"><span class="glyphicon glyphicon-lock">&nbsp;</span>Password </label>
                        <input id="pss" class="form-control" type="password" />
                    </div>
                    <!------------------------------------------------------------------->
                    <?php $rand = rand(1000, 9999); ?>
                    <div class="form-group text-right">
                        <label>Enter Code Please : <?php echo $rand; ?></label>
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group">
                        <input id="num" class="form-control" placeholder="اكتب الكود" required="" type="text">
                        <input id="num-m" style="display:none" class="form-control" required="" type="text"
                            value="<?php echo $rand; ?>">
                        <input id="token_m" style="display:none" class="form-control" required="" type="text"
                            value="<?php echo $_SESSION['csrf_token']; ?>">
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group text-center">
                        <button class="btn btn-default" onclick="_login()" type="button">
                            <span class="glyphicon glyphicon-lock">&nbsp;</span>Login
                        </button>
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group" id="logInSuccess">
                        <div class="alert alert-success form-control text-center">
                            <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
                            <strong>Congrats !</strong> Signed Successfully
                        </div>
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group" id="logInError">
                        <div class="alert alert-danger form-control text-center">
                            <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
                            <strong>Error !</strong> Error in User name or Password
                        </div>
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group" id="captchaError">
                        <div class="alert alert-danger form-control text-center">
                            <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
                            <strong>Error !</strong> Error in Code 
                        </div>
                    </div>
                    <!------------------------------------------------------------------->
                    <div class="form-group" id="emptyLogInError">
                        <div class="alert alert-danger form-control text-center">
                            <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
                            <strong>Error !</strong>Please insert all fields
                        </div>
                    </div>
                    <!------------------------------------------------------------------->
                </form>
            </div>
            <div class="col-sm-4   col-md-4  col-lg-4">
            </div>
        </div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sha.256.js"></script>
<script src="js/scripts.js"></script>
<script src="js/login.js"></script>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        _login();
    }
});
</script>

</html>