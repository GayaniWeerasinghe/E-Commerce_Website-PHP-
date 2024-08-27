<?php

session_start();
session_unset();
session_destroy();
echo "<script>window.open('../index.php','_self')</script>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>logout</h1>
</body>
</html>