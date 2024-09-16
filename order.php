<?php
 require 'config.php';

 if(isset($_GET['id'])){
 		$id = $_GET['id'];
 		$sql = "SELECT * FROM product WHERE id='$id'";
 		$result = mysqli_query($conn, $sql);
 		$row = mysqli_fetch_array($result);
		 $pid = $row['id'];
 		$pname = $row['product_name'];
 		$pprice = $row['product_price'];
 		$del_charge = 50;
 		$total_price = $pprice + $del_charge;
 		$pimage =  $row['product_image'];
 }else{
 	echo 'No product found!';
 }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complete Your order</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">Testing</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>
      </li>
    </ul>
  </div>
</nav>
 <div class="container">
 		<div class="row justify-content-center">
 			<div class="col-md-10 mb-5">
 				<h2 class="text-center p-2 text-primary">Fill the details to complete your order</h2>
 				<h3>Product Details : </h3>
 				<table class="table table-bordered" width="500px">
 					<tr>
 						<th>Product Name :</th>
 						<td><?= $pname; ?></td>
 						<td rowspan="4" class="text-center"><img src="<?= $pimage; ?>" width="200"></td>
 					</tr>
 					<tr>
 						<th>Product Price :</th>
 						<td>Rs. <?= number_format($pprice); ?>/-</td>
 					</tr>
 					<tr>
 						<th>Delivery Charge :</th>
 						<td>Rs. <?= number_format($del_charge); ?>/-</td>
 					</tr>
 					<tr>
 						<th>Total Price :</th>
 						<td>Rs. <?= number_format($total_price); ?>/</td>
 					</tr>
 				</table>
 				<h4>Enter Your Details :</h4>
 				<form action="" method="post" accept-charset="utf-8">
 					<input type="hidden" name="product_name" value="<?= $pname; ?>">
 					<input type="hidden" name="product_price" value="<?= $pprice; ?>">
 					<div class="form-group">
 						<input type="text" name="name" class="form-control" placeholder="Enter your name" required>
 					</div>
 					<div class="form-group">
 						<input type="email" name="email" class="form-control" placeholder="Enter your email" required>
 					</div>
 					<div class="form-group">
 						<input type="tel" name="phone" class="form-control" placeholder="Enter your phone" required>
 					</div>
 					<div class="form-group">
					 <a href="javascript:void(0)"  data-prodcut_id="<?php echo $pid;?>" data-product_name="<?php echo $pname;?>" data-product_price="<?php echo $pprice; ?>" data-total_price="<?= $total_price; ?>" data-pimage="<?= $pimage; ?>"  class="btn btn-primary buynow">Buy Now</a>
 					<a href="index.php" class="btn btn-danger">Back</a>
					</div>
					
 				</form>
 			</div>
 		</div>
 </div>
 
 <?php 

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
$(".buynow").click(function()
{

var product_name=$(this).attr('data-product_name');	
var price=$(this).attr('data-product_price');	

var product_id=$(this).attr('data-prodcut_id');	
var total_price=$(this).attr('data-total_price');	
var pimage=$(this).attr('data-pimage');	

var options = {
    "key": "rzp_test_Ju7WZ5J7d84ZyE",
    "amount": total_price*100,
    "name": "The Digital Oceans",
    "description": product_name,
    "image": pimage,
    "handler": function (response){
        var paymentid=response.razorpay_payment_id;
		
		$.ajax({
			url:"payment-process.php",
			type:"POST",
			data:{product_id:product_id,payment_id:paymentid},
			success:function(finalresponse)
			{
				if(finalresponse=='done')
				{
					console.log(finalresponse);
					window.location.href="http://localhost/shopping/success.php";
				}
				else 
				{
					alert('Please check console.log to find error');
					console.log(finalresponse);
				}
			}
		})
        
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
 rzp1.open();
 e.preventDefault();
});
</script>
</body>
</html>