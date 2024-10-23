<?php
session_start();
if (!isset($_SESSION['uname']) || !isset($_SESSION['csrf_token'])) {
    echo '<script>window.location="index.php";</script>';
} else {
    if (!isset($_GET['date'])) {
        $date = date("Y-m-d");
    } else {
        $date = $_GET['date'];
    }
    //echo  $date;  
    include '_inc/__fun.php';
    $row = get_usertype($_SESSION['uname']);
    foreach ($row as $row) {
        $type = $row['type'];
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="description" content="Source code generated using rand.sy">
        <meta name="author" content="rand.sy">
        <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com" />
        <!------------------------------------------------------------------->
        <link href="./css/ico/favicon.ico" rel="shortcut icon" />
        <title>Rand Services</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/css.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/font.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/dialog.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/all.css" />
        <style>
            a {
                cursor: pointer;
            }

            span.glyphicon {
                font-size: 1.2em;
            }

            td:hover {
                background-color: #1fcad9;
                color: #fff;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12  col-sm-12  col-md-12  col-lg-12  col-lg-12">
                    <?php include 'header1.php'; ?>
                    <div class="row">
                        <div class="col-sm-12  col-sm-12  col-md-12  col-lg-12  col-lg-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12  col-sm-12  col-md-12  col-lg-12  col-lg-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12  col-sm-12  col-md-12  col-lg-12  col-lg-12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4  col-md-4  col-lg-4"></div>
                <div class="col-sm-4  col-md-4  col-lg-4">
                    <form role="form" method="GET" action="unsent.php">
                        <div class="form-group">
                            <label for="">
                                Date
                            </label>
                            <input class="form-control" type="text" name="date" id="sdate"><br>
                            <div class="form-group">
                                <input type="submit" value="Search">
                            </div>
                            <div class="col-sm-4  col-md-4  col-lg-4">Date : <?php echo $date; ?></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-12  col-lg-12">
                <table class="table table-bordered table-hover table-condensed">
                    <tbody>
                    </tbody>
                </table>
                <table class="table table-bordered table-condensed" id="example">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Category
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res_ctg_n = get_ctg_not_sent($date);
                        $i = 1;
                        foreach ($res_ctg_n as $row) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php echo $row["name"]; ?>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-right">Modal title</h4>
                    </div>
                    <div class="modal-body text-right">
                        <p>One fine body…</p>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/dialog.js"></script>
        <script src="js/send1.js"></script>
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script>
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
                format: 'Y-m-d'
                //startDate:	'output'
            });
            //$('#datetimepicker').datetimepicker({value:output,step:10});
        </script>
    </body>

    </html>
<?php
}
?>