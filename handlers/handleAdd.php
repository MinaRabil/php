<?php

require_once '../inc/conn.php';
require_once '../classes/request.php';
require_once '../classes/session.php';
require_once '../classes/validation.php';

use Route\Oop\Exam\Request;

use Route\Oop\Required\Session;
use Route\Oop\Required\Validation;

$request= new Request;
$session = new Session;
$validation = new Validation;




//check 

if($request->check($request->post('submit'))){
    
//catch  
$name = $request->clean($request->post('name'));
$price = $request->clean($request->post('price'));
$description = $request->clean($request->post('desc'));
$imageName=$_FILES['file']["name"];
$imgTemp =$_FILES["file"]['tmp_name'];
$imgDir ="../images/";
$imgList =scandir($imgDir);
$uploaded= move_uploaded_file($imgTemp,"../images/$imageName");
$image="images/".$_FILES['file']["name"];


//validation class (required  , strnig)
//title
$validation->lastValidate("name",$name,["Required","Str"]);
$validation->lastValidate("description", $description, ["required", "str"]);
$validation->lastValidate("price", $price,["required"]);
$validation->lastValidate("image", $imageName,["required"]);
$errors =$validation->getError();
if(empty($errors)){

   $result= $conn->prepare("insert into product(`name`,`price`,`description`,`image`) values (:name,:price,:description,:image)");
   $result->bindParam(":name", $name);
   $result->bindParam(":price", $price);
   $result->bindParam(":description", $description);
   $result->bindParam(":image", $image);

    $result->execute();
    if($result){
        $session->set("success","Data inserted successfully");
        $request->redirect("../index.php");
    }else{
        $session->set("errors",["Error while insert"]);
        $request->redirect("../index.php");
    }
}else{
    $session->set("error", $errors);
    $error =$session->get("error");
    foreach ($error as $key ) {
        echo $key."<br>";
    }
}
//insert

//errors



}else{
    $request->redirect("../index.php");
}

