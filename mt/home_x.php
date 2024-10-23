<?php session_start();
//var_dump($_SESSION);
//setcookie(session_name(), session_id(), NULL, NULL, NULL, 0);


if (!isset($_SESSION['uname']) || !isset($_SESSION['id']) || !isset($_SESSION['csrf_token'])) {
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

    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com" />

        <meta name="description" content="Source code generated using rand.sy">
        <meta name="author" content="rand.sy">

        <!------------------------------------------------------------------->
        <link href="./css/ico/favicon.ico" rel="shortcut icon" />
        <title>Rand Services</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/css.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/font.css" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12  col-md-12 col-lg-12">
                    <?php
                    include 'header1.php';
                    ?>
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
                                    <select class="form-control" id="service_id" style="padding-top:0px;direction:rtl;float:right">
                                        <?php
                                        if ($type == 7 && $_SESSION['uname'] != 'YazanG' && $_SESSION['uname'] != 'HossamN' && $_SESSION['uname'] != 'Khaledkh' && $_SESSION['uname'] != 'HeshamB' && $_SESSION['uname'] != 'MhdSaad') {
                                            $result = get_all("cp_services1", "1=1 order by id asc");
                                            $i = 1;
                                            foreach ($result as $row) {
                                                //echo $row["name"]."</br>";
                                                if (
                                                    $i == 13 || $i == 25 || $i == 26 || $i == 27 || $i == 28 || $i == 29
                                                    || $i == 30 || $i == 31 || $i == 32 || $i == 33 || $i == 36 || $i == 37
                                                    || $i == 38 || $i == 39 || $i == 40 || $i == 41 || $i == 43  || $i == 47
                                                    || $i == 59  || $i == 60 || $i == 61 || $i == 85 || $i == 90 || $i == 91 || $i == 92
                                                    || $i == 93  || $i == 94 || $i == 95 || $i == 98 || $i == 99 || $i == 111 || $i == 112
                                                    || $i == 113 || $i == 114
                                                    || $i == 115 || $i == 116    || $i == 129  || $i == 130 ||   $i == 142
                                                    || $i == 143
                                                    || $i == 144 || $i == 145 || $i == 146 || $i == 147 || $i == 148     || $i == 160  || $i == 161 || $i == 166 || $i == 167  || $i == 168



                                                ) {
                                                    echo '<option disabled>----------------------</option>';
                                                }
                                                if (
                                                    $row['code'] == 'SABAYA_2' || $row['code'] == 'SABAYA_3' || $row['code'] == 'SABAYA_4'
                                                    || $row['code'] == 'SABAYA_3_F' || $row['code'] == 'SABAYA_4_F'
                                                    || $row['code'] == 'COM_VASWRD'  || $row['code'] == 'S1_BUND_W'
                                                    || $row['code'] == 'S2_BUND_W' || $row['code'] == 'S3_BUND_W' || $row['code'] == 'S4_BUND_W'
                                                    || $row['code'] == 'INAAA_F' || $row['code'] == 'WTECH_F' || $row['code'] == 'LOCKIN230'
                                                    || $row['code'] == 'LOCKIN_3'  || $row['code'] == 'LOCKIN_2' || $row['code'] == 'MOTH_WEK'
                                                    || $row['code'] == 'ISHOW_BOXV' ||
                                                    $row['code'] == 'ADGYM_W'

                                                ) {
                                                    $i++;
                                                } else {
                                                    echo '<option value=' . $row['code'] . '>' . $row['name'] . '</option>';
                                                }
                                                $i++;
                                            }
                                        } else {
                                            $result = get_all("cp_services1", "cat_id=11 or cat_id=81  or cat_id=77");
                                            $i = 1;
                                            foreach ($result as $row) {
                                                echo '<option value=' . $row['code'] . '>' . $row['name'] . '</option>';
                                            }
                                        }
                                        if ($type == 1) {
                                            $result = get_all("cp_services1", "cat_id=11");
                                            foreach ($result as $row) {
                                                echo '<option value=' . $row['code'] . '>' . $row['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="smstxt">
                                        SMS Content
                                    </label>
                                    <textarea style="font-size:1.01em;direction:rtl" class="form-control text-right" id="smstxt" maxlength="500" rows="10" onkeyup='change_char_num()' onmousedown='change_char_num()' onmousedown='change_char_num()' onmouseout='change_char_num()' onclick='change_char_num()'>
							</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        Remaining Characters : <span id="char_num">500</span>
                                    </label>
                                </div>



                                <button type="button" class="btn btn-default" onclick="_Test_MTN_Mt()">
                                    <span class="glyphicon glyphicon-check">&nbsp;</span>
                                    <b>Test SMS Content (MTN)</b>
                                </button>
                                <br>
                                <br>
                                <div class="form-group text-center" id="ErrorResponse" style="display:none">
                                    <span class="danger" style="color:red; font-family: cursive">
                                        <h3>Text Not Sent !</h3>
                                    </span>
                                </div>

                                <div class="form-group text-center" id="SuccessResponse" style="display:none">
                                    <span class="success" style="color:green;font-family: cursive">
                                        <h3>Text Sent</h3>
                                    </span>
                                </div>

                                <div class="form-group text-center" id="ContentExistResponse" style="display:none">
                                    <span class="success" style="color:red;font-family: cursive">
                                        <h3>Content Exist for the Date below!</h3>
                                    </span>
                                </div>



                                <div class="form-group">
                                    <label for="sdate">
                                        Sending Date
                                    </label>
                                    <input type="text" class="form-control" id="sdate" placeholder="select time">
                                </div>
                                <div class="form-group text-center" id="res" style="display:none">
                                    <h3> <span class="success">success</span></h3>
                                </div>
                                <div class="form-group">
                                    <button id="addButton" type=" button" class="btn btn-success" onclick="_send()">
                                        <span class="glyphicon glyphicon-send">&nbsp;</span>Add
                                    </button>
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-remove">&nbsp; </span>Clear
                                    </button>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
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
            minDate: 0,
            //startDate:	'output'
        });
        //$('#datetimepicker').datetimepicker({value:output,step:10});
        function change_char_num() {
            $char_num = $('#smstxt').val();
            $len = $char_num.length;
            $('#char_num').html('');
            $new_len = 500 - $len;
            $('#char_num').html($new_len);

        }



        console.log("home");
    </script>

    </html>
<?php
}
?>