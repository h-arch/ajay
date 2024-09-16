<?php
  require 'config.php';

$product_name = $_POST['product_name'];
$price = $_POST['product_price'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// echo $product_name.'<br>';
// echo $price.'<br>';
// echo $name.'<br>';
// echo $email.'<br>';
// echo $phone;


// $api = "";

// try {
//     $response = $api->createPaymentRequest(array( 
//         "purpose" => "$product_name",
//         "amount" => "$price",
//         "send_email" => true,
//         "email" => "$name",
//         "buyer_name" => "$email",
//         "phone" => "$phone",
//         "send_sms" => true,
//         "allow_repeated_payments" => false,
//         "redirect_url" => "http://localhost/shopping/thankyou.php"
//         ));
//     print_r($response);
//     $pay_url = $response['longurl'];
//     header("location:$pay_url");
// }
// catch (Exception $e) {
//     print('Error: ' . $e->getMessage());
// }



?>
<script>

// $(".buynow").click(function()
// {

// var amount=$(this).attr('data-amount');	
// var productid=$(this).attr('data-productid');	
// var productname=$(this).attr('data-productname');	
	
var options = {
    "key": "rzp_test_zHhNFsppG7bIjH",
    "amount": "$price",
    "name": "$name",
    "description": "$product_name",
    "image": "https://example.com/your_logo",
    "handler": function (response){
        var paymentid=response.razorpay_payment_id;
		console.log(response);
        console.log(paymentid);
		// $.ajax({
		// 	url:"payment-process.php",
		// 	type:"POST",
		// 	data:{product_id:productid,payment_id:paymentid},
		// 	success:function(finalresponse)
		// 	{
		// 		if(finalresponse=='done')
		// 		{
		// 			window.location.href="shopping\success.php";
        //             console.log(finalresponse);
		// 		}
		// 		else 
		// 		{
		// 			alert('Please check console.log to find error');
		// 			console.log(finalresponse);
		// 		}
		// 	}
		// })
        
    },
    "theme": {
        "color": "#3399cc"
    }
};
// var rzp1 = new Razorpay(options);
//  rzp1.open();
//  e.preventDefault();
// });
</script>