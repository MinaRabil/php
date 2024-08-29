<?php

require_once 'classes/request.php';
require_once 'classes/session.php';
require_once 'classes/validation.php';
require_once 'inc/conn.php';




use Route\Oop\Exam\Request;

use Route\Oop\Required\Session;
use Route\Oop\Required\Validation;

$request= new Request;
$session = new Session;
$validation = new Validation;
if ( $request->check($request->get('id'))) {
    $id = $request->get('id');
    $run = $conn->prepare("delete from product where id=:id");
    $run->bindParam(":id",$id);
    $run->execute();
    echo "done";
    $request->redirect("index.php");


}else{
echo "dfs";
}

