<?php
session_start();
if (!isset($_SESSION['uname']) || !isset($_SESSION['csrf_token'])) {
    header("location='index.php'");
} else {
    include '_inc/__fun.php';
    $row = get_usertype($_SESSION['uname']);
    foreach ($row as $row) {
        $type = $row['type'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Source code generated using rand.sy" />
    <meta name="author" content="rand.sy" />

    <!------------------------------------------------------------------->
    <link href="./css/ico/favicon.ico" rel="shortcut icon" />
    <title>Rand Services</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/css.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/dialog.css" />

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
                <?php
                    include 'header1.php';
                    ?>
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
                                SMS
                            </th>
                            <th>
                                Sending Date
                            </th>
                            <th>
                                Service
                            </th>
                            <?php
                                if ($type == '7') { ?>
                            <th>Action</th>
                            <?php
                                }
                                ?>
                            <th>
                                Status
                            </th>
                            <th>
                                Update
                            </th>
                            <th>
                                Delete
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sms = '';
                            if ($_SESSION['uname'] != 'YazanG' && $_SESSION['uname'] != 'HossamN' && $_SESSION['uname'] != 'Khaledkh' && $_SESSION['uname'] != 'HeshamB' && $_SESSION['uname'] != 'MhdSaad') {
                                $sms = get_all("cp_sms", "1=1 order by id desc limit 800");
                            } else {
                                $sms = get_all("cp_sms", "ctg='MADRIDISTA' or ctg='CHAMPIONS' or ctg='CATALONY' or ctg='EUROPA' 
								or ctg='CAPT_SRV' 
								or ctg='GOAL_M'
								order by dt desc limit 500");
                            }
                            $i = 1;

                            foreach ($sms as $row) {
                            ?>
                        <tr>
                            <td>
                                <?php echo $i; ?>
                            </td>

                            <td dir="rtl">
                                <?php echo $row['mtxt']; ?>
                            </td>
                            <td style="text-align:center;white-space: nowrap;">
                                <?php echo $row['dt']; ?>
                            </td>
                            <td>
                                <?php //echo $row['ctg'];
                                        $serv = get_all("cp_services1", "code='" . $row['ctg'] . "'");
                                        foreach ($serv as $row_serv) {
                                            echo $row_serv["name"];
                                        }
                                        ?>
                            </td>


                            <?php if ($type == '7' && $row['status'] == 'not sent') { ?>
                            <td style="text-align:center;white-space: nowrap;">
                                <a href="#" title="OK"><span
                                        class="glyphicon glyphicon-ok-sign glyphicon-lg"></span></a>
                                <a href="#" title="Not OK"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                            <?php
                                    }

                                    ?>

                            <?php if ($type == '7' && $row['status'] == 'sent') { ?>
                            <td style="text-align:center">
                                Approved
                            </td>
                            <?php
                                    }

                                    ?>


                            <td class="text-right" style="text-align:center">
                                <?php if ($row['status'] == 'not sent') { ?>
                                <a href="#" title="Not Sent">Not sent</a>
                                <?php
                                        }
                                        if ($row['status'] == 'sent') { ?>
                                <a href="#" title="Sent">Sent</a>
                                <?php
                                        }
                                        ?>
                            </td>
                            <td class="text-center">

                                <a href="update.php?id=<?php echo $row['id']; ?>" title="update"><span
                                        class="glyphicon glyphicon-pencil"></span></a>
                            </td>
                            <td class="text-center">

                                <a type="button" title="delete" onclick="showDeleteDialog(<?php echo $row['id']; ?>)">
                                    <span class="glyphicon glyphicon-remove"></span></a>
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

    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/dialog.js"></script>
    <script src="js/send1.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable(

        );
    });
    </script>

</body>

</html>

<?php
}
?>