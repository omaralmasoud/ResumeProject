<?php

    // Config Page

    // Make a Connection
    $servername = 'localhost';
    $serveruser = 'root';
    $serverpass = '';
    $serverdatabase = 'cv';
    $connectdb = mysqli_connect($servername,$serveruser,$serverpass,$serverdatabase) or die(mysqli_connect_error());

    if(mysqli_connect_error())
    {
        // Connection down
        echo 'حدث خطأ بالاتصال بقواعد البيانات';
    }
 ?>