<?php

// connection database

$conn = mysqli_connect('localhost','shawn','12312345','addrequest');


if(!$conn){
    echo 'connection error: '. mysqli_error();
}


?>