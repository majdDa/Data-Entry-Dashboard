<?php
//include_once("_inc/header.php");
session_start();
if (!isset($_SESSION['uname']) || !isset($_SESSION['csrf_token'])) {
    echo '<script>window.location="index.php";</script>';
} else {

    include '_inc/__fun.php';
    $res_sms = get_all("cp_sms", "id='" . $_REQUEST['id'] . "'");
    // var_dump($res_sms);
    foreach ($res_sms as $row_sms) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible" />
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            <meta name="description" content="Source code generated using rand.sy">
            <meta name="author" content="rand.sy">

            <!------------------------------------------------------------------->
            <link href="./css/ico/favicon.ico" rel="shortcut icon" />
            <title>Rand Services</title>
            <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/css.css" />
        </head>

        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12  col-md-12 col-lg-12">
                        <nav class="navbar navbar-default" role="navigation" style="background-color:#1ccce1;">
                            <div class="navbar-header">

                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">&nbsp;</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                                </button> <a class="navbar-brand" href="#">Rand</a>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active">
                                        <a href="home_x.php"><span class="glyphicon glyphicon-send">&nbsp;</span>Add SMS</a>
                                    </li>
                                    <li>
                                        <a href="sms.php"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Browse</a>
                                    </li>
                                    <li>
                                        <a href="unsent.php"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span>Unsent
                                            Categories</a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="logout.php"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="row">
                            <div class="col-sm-12  col-md-12 col-lg-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12  col-md-12 col-lg-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4   col-md-4  col-lg-4">
                            </div>
                            <div class="col-sm-4   col-md-4  col-lg-4">
                                <form role="form">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Service name
                                        </label>
                                        <select class="form-control" id="service_id">
                                            <?php
                                            $result = get_all("cp_services1", "code='" . $row_sms['ctg'] . "'");
                                            foreach ($result as $row) {
                                                echo '<option value=' . $row['code'] . '>' . $row['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="smstxt">
                                            SMS Content
                                        </label>
                                        <textarea class="form-control text-right" id="smstxt" maxlength="500"><?php echo $row_sms['mtxt']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="sdate">Sending Date</label>
                                        <input type="text" class="form-control" id="sdate" value="<?php echo $row_sms['dt']; ?>">
                                    </div>
                                    <div class="form-group text-center" id="res" style="display:none">
                                        <span class="success">success</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" onclick="_update(<?php echo $_REQUEST['id']; ?>)">
                                            <span class="glyphicon glyphicon-send">&nbsp;</span>update
                                        </button>
                                        <a href="sms.php"><button type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-remove">&nbsp; </span>Cancel
                                            </button></a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-4   col-md-4  col-lg-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script type="application/javascript" src="js/jquery.min.js"></script>
        <script type="application/javascript" src="js/bootstrap.min.js"></script>
        <script type="application/javascript" src="js/scripts.js"></script>
        <script type="application/javascript" src="js/update.js"></script>
        <script type="application/javascript" src="js/jquery.datetimepicker.full.js"></script>
        <script type="application/javascript">
            $.datetimepicker.setLocale('en');
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();
            var output = d.getFullYear() + '/' +
                (month < 10 ? '0' : '') + month + '/' +
                (day < 10 ? '0' : '') + day;

            $('#sdate').datetimepicker({
                dayOfWeekStart: 1,
                lang: 'en',
                disabledDates: [''],
               // startDate: 'output'
					 minDate: 0,
            });
            //$('#datetimepicker').datetimepicker({value:output,step:10});
        </script>
    <?php
    }
    ?>

        </html>
    <?php
}
    ?>