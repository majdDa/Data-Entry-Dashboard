<?php

include '_inc/__fun.php';
?>
<div class="col-md-12">
    <nav class="navbar navbar-default row" role="navigation" style="background-color:#1ccce1;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">&nbsp;</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                    class="icon-bar"></span>
            </button> <a class="navbar-brand" href="#">Rand</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php"><span class="glyphicon glyphicon-send">&nbsp;</span>Add SMS</a>
                </li>
                <li>
                    <a href="sms.php"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Browse</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <form role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">
                        Service name
                    </label>
                    <select class="form-control" id="service_id">
                        <?php
						$result = get_all("cp_services", "1=1");
						foreach ($result as $result) {
							//echo $row["name"]."</br>";
							echo '<option value=' . $row['code'] . '>' . $row['name'] . '</option>';
						}
						?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="smstxt">
                        SMS Content
                    </label>
                    <textarea class="form-control text-right" id="smstxt" maxlength="268">
							</textarea>
                </div>
                <div class="form-group">
                    <label for="sdate">
                        Sending Date
                    </label>
                    <input type="text" class="form-control" id="datetimepicker">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-default" onclick="_send()">
                        <span class="glyphicon glyphicon-send">&nbsp;</span>Add
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-remove">&nbsp; </span>Clear
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>