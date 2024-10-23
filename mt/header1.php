<nav class="navbar navbar-default row" role="navigation" style="background-color:#1fcad9;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">&nbsp;</span><span class="icon-bar"></span><span class="icon-bar"></span><span
                class="icon-bar"></span>
        </button> <a class="navbar-brand" href="#">Rand</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php
            if ($type == 7) {
            ?>
            <li class="active">
                <a href="home_x.php"><span class="glyphicon glyphicon-send">&nbsp;</span>Add SMS</a>
            </li>
            <li>
                <a href="sms.php"><span class="glyphicon glyphicon-calendar">&nbsp;</span>Browse</a>
            </li>
            <?php if ($_SESSION['uname'] != 'YazanG' && $_SESSION['uname'] != 'HossamN' && $_SESSION['uname'] != 'Khaledkh' && $_SESSION['uname'] != 'HeshamB' && $_SESSION['uname'] != 'MhdSaad') {
                ?>
            <li>
                <a href="unsent.php"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span>Unsent Categories</a>
            </li>
            <?php
                }
            }
            if ($type == 1) { ?>
            <li class="active">
                <a href="home_x.php"><span class="glyphicon glyphicon-send">&nbsp;</span>Add SMS</a>
            </li>

            <?php
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#"><span class="glyphicon glyphicon-user">&nbsp;</span>Welcome
                    <?php echo $_SESSION['uname']; ?></a>
            </li>
            <li>
                <a href="logout.php"><span class="glyphicon glyphicon-log-out">&nbsp;</span>Logout</a>
            </li>

        </ul>
    </div>
</nav>