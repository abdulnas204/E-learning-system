<?php

session_start();
if(isset($_SESSION['admin']))
{
    session_destroy();
    echo "<script> window.location.href = 'index'; </script>";
    exit;
}
elseif(isset($_SESSION['tutor']))
{
    session_destroy();
    echo "<script> window.location.href = 'index'; </script>";
    exit;
}
elseif(isset($_SESSION['students']))
{
    session_destroy();
    echo "<script> window.location.href = 'index'; </script>";
    exit;
}



?>