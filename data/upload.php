<?php
	error_reporting(0);
    $filename =  $_POST['fileid'];
    if ( 0 < $_FILES['file']['error'] ) {
        echo json_encode( array("error"=> $_FILES['file']['error'] ) );
    }
    else {
    	$ext =strtolower( array_pop( explode(".", $_FILES['file']['name']) ) );
    	$allowed_ext = array('jpg','jpeg','png','gif');

    	if(!in_array($ext,$allowed_ext)){
    		//echo json_encode( array("error"=> "格式错误，请重新选择") );
    		//exit();
    	}
    	//$filename = date('Ymdhia'). rand(100,999). ".$ext";
        //$filename = $filename . ".$ext";
        move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $filename );
        echo json_encode( array("filename"=> $filename) );
    }


?>
