<?php session_start();

if (!isset($_SESSION['uname']) || !isset($_SESSION['id']) || !isset($_SESSION['csrf_token'])) {
	echo '<script>window.location="index.php";</script>';
} else {
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
    <meta http-equiv="Content-Security-Policy"
        content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com" />
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
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12  col-sm-12  col-md-12  col-lg-12  col-lg-12">
                <?php
					if ($_SESSION['id'] > 8) {
						include 'header2.php';
					} else {
						include 'header1.php';
					}
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
                <button id="save" class="btn btn-danger" type="button">
                    <span class="fa fa-save">&nbsp;</span>Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12  col-md-12  col-lg-12">
                <table class="table table-bordered table-hover table-condensed">
                </table>
                <table id="example" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th># </th>
                            <th>Service </th>
                            <th>Sending Date </th>
                            <th>Editing Date </th>
                            <th>Update </th>
                            <th>Cancel </th>
                        </tr>
                    </thead>
                    <?php
						$res = '';
						if ($_SESSION['id'] == 1 || $_SESSION['id'] == 12 || $_SESSION['id'] == 13) {
							$res = get_all("cp_monitoring", "1=1");
						} else {
							$res = get_all("cp_monitoring", "user_id='" . $_SESSION['id'] . "'");
						}
						$i = 1;
						foreach ($res as $res) {
						?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row["service_name"]; ?></td>
                        <td id="td_sending_date-<?php echo $row["id"]; ?>">
                            <input id="sending_date-<?php echo $row["id"]; ?>" type="text"
                                value="<?php echo $row["sending_date"]; ?>" disabled />
                            <input id="val_sending_date-<?php echo $row["id"]; ?>" type="text"
                                value="<?php echo $row["sending_date"]; ?>" style="display:none" />
                        </td>
                        <td id="td_editing_date-<?php echo $row["id"]; ?>">
                            <input id="editing_date-<?php echo $row["id"]; ?>" type="text"
                                value="<?php echo $row["editing_date"]; ?>" disabled />
                            <input id="val_editing_date-<?php echo $row["id"]; ?>" type="text"
                                value="<?php echo $row["editing_date"]; ?>" style="display:none" />
                        </td>
                        <td>
                            <button id="update-<?php echo $row["id"]; ?>" class="btn btn-info" type="button">
                                <span class="fa fa-edit">&nbsp;</span>Update</button></td>
                        <td>
                            <button id="Cancel-<?php echo $row["id"]; ?>" class="btn btn-warning" type="button">
                                <span class="fa fa-arrow-left">&nbsp;</span>Cancel</button></td>
                    </tr>
                    <?php
						}
						?>
                </table>
            </div>
            <input type="text" id="user-id" value="<?php echo $_SESSION['id']; ?>" style="display:none">
        </div>
        <div class="row">
            &nbsp;</div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 text center">
                All rights reserved by <b> Rand Service Desk Team </b> @ <?php echo date('Y'); ?> .
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/send1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script>
    $().ready(function() {
        $('button[id^="update-"]').click(
            function() {
                var id = $(this).attr("id");
                var id_split = id.split("-");
                id = id_split[1];
                var user_id = $("#user-id").val();
                if (user_id == 1 || user_id == 4 || user_id == 5 || user_id == 6 || user_id == 7 ||
                    user_id == 8 || user_id == 9 || user_id == 10 || user_id == 11) {
                    $("#sending_date-" + id).prop("disabled", false);
                    $("#td_sending_date-" + id).css("background-color", "#1fcad9");
                }
                if (user_id == 1 || user_id == 12 || user_id == 13) {
                    $("#editing_date-" + id).prop("disabled", false);
                    $("#td_editing_date-" + id).css("background-color", "#1fcad9");
                }
            }
        );
        $('button[id^="Cancel-"]').click(
            function() {
                var id = $(this).attr("id");
                var id_split = id.split("-");
                id = id_split[1];
                var user_id = $("#user-id").val();
                if (user_id == 1 || user_id == 4 || user_id == 5 || user_id == 6 || user_id == 7 ||
                    user_id == 8 || user_id == 9 || user_id == 10 || user_id == 11) {
                    $("#sending_date-" + id).prop("disabled", true);
                    $("#sending_date-" + id).val("");
                    $("#td_sending_date-" + id).css("background-color", "#fff");
                }
                if (user_id == 1 || user_id == 12 || user_id == 13) {
                    $("#editing_date-" + id).prop("disabled", true);
                    $("#editing_date-" + id).val("");
                    $("#td_editing_date-" + id).css("background-color", "#fff");
                }
            }
        );
        $('input[id^="sending_date-"]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('input[id^="editing_date-"]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#save").click(
            function() {
                var id_array = [];
                var sending_date_array = [];
                var editing_date_array = [];
                var user_id = $("#user-id").val();
                if (user_id == 1 || user_id == 4 || user_id == 5 || user_id == 6 || user_id == 7 ||
                    user_id == 8 || user_id == 9 || user_id == 10 || user_id == 11) {
                    $('input[id^="sending_date-"]').each(
                        function() {
                            var id = $(this).attr("id");
                            var id_split = id.split("-");
                            id = id_split[1];
                            var val1 = $("#sending_date-" + id).val();
                            var val2 = $("#val_sending_date-" + id).val();
                            if (val1 === val2) {
                                //alert(true);
                            } else {
                                id_array.push(id);
                                sending_date_array.push(val1);
                                $.post("pages/update/update_task_sdate.php", {
                                        id_array: id_array,
                                        sending_date_array: sending_date_array,
                                    },
                                    function(data, status) {
                                        alert("تم التعديل بنجاح");
                                        window.location = "tasks.php";
                                    }
                                );
                            }
                        }
                    );
                }
                if (user_id == 1 || user_id == 12 || user_id == 13) {
                    $('input[id^="editing_date-"]').each(
                        function() {
                            var id = $(this).attr("id");
                            var id_split = id.split("-");
                            id = id_split[1];
                            var val1 = $("#editing_date-" + id).val();
                            var val2 = $("#val_editing_date-" + id).val();
                            if (val1 === val2) {
                                //alert(true);
                            } else {
                                id_array.push(id);
                                editing_date_array.push(val1);
                                $.post("pages/update/update_task_edate.php", {
                                        id_array: id_array,
                                        editing_date_array: editing_date_array,
                                    },
                                    function(data, status) {
                                        alert("تم التعديل بنجاح");
                                        window.location = "tasks.php";
                                    }
                                );
                            }
                        }
                    );
                }
            }
        );
    });
    </script>
</body>

</html>
<?php
}
?>