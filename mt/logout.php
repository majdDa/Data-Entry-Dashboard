<?php


 session_start();

      unset($_SESSION['uname']);
      unset($_SESSION['csrf_token']);
      session_destroy();
      echo '<script> window.location="index.php";</script>';