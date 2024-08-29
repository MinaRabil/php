<?php include 'inc/header.php'; 
require_once 'inc/App.php';?>



<div class="container my-5">

    <div class="row">
    <?php 
if ($request->check($request->get('id'))){
$id=$request->get('id');
$result = $conn->query("select * from product where id = $id");

$product = $result->fetch(PDO::FETCH_ASSOC)
?>

    <div class="col-lg-6">
            <img src="images/one.jpg" class="card-img-top">
            </div>
            <div class="col-lg-6">
            <h5 >product 1</h5>
            <p class="text-muted">Price: 2000 EGP</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <a href="index.php" class="btn btn-primary">Back</a>
            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-info">Edit</a>
            <a href="del.php?id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>
        </div>
        
    </div>
</div>
<?php }?>



<?php include 'inc/footer.php'; ?>