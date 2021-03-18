<?php
include_once "01 db.php";
include_once "utill.php";
$debug_mode = false;
    if($_SERVER['REQUEST_METHOD']=='GET'){
        debug_text("GET METHOD Process...",$debug_mode);
        echo json_encode(show_data($debug_mode));
    }else if($_SERVER['REQUEST_METHOD']=='POST'){
        debug_text("POST METHOD May be Implement soon...",$debug_mode);
        $message = array("status"=>print_r($_POST));
        adddata($debug_mode, $_POST['u_name'], $_POST['u_age']);
        //echo json_encode($message);
    }else{
        debug_text("ERROR Unsupport this request",$debug_mode);
        http_response_code(405);
    }


    function show_data($debug_mode){
        $mydb = new db("root","","personal",$debug_mode);
        $data = $mydb->query("select * from data");
        //print_r($data);
        $mydb->close();
        return $data;
    }

    function adddata($debug_mode,$name,$age){
        $mydb = new db("root","", "personal", $debug_mode);
        $mydb->query("INSERT INTO `data`(`name`, `age`) VALUES ({'$name'},{$age})");
        $mydb->close();
    }
?>