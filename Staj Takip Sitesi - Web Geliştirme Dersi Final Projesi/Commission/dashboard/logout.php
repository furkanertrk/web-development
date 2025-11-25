<?php

session_start();
session_unset();
session_destroy();
header('location: ../../commission_login.php?commission-logout=success');