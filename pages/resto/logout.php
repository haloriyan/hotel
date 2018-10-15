<?php
session_start();
unset($_SESSION['uresto']);
header("location: ../hotel/restaurant");