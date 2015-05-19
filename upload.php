<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
    	$ext = array_pop( explode(".", $_FILES['file']['name']) );
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . date('Ymdhia'). rand(100,999). ".$ext" );
    }


?>
