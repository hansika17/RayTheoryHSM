
	 <link rel="stylesheet" href="css/bootstrap.min.css">
<style>
	 #centerdiv {
    position: fixed;
    top: 20%;
    left: 40%;
    margin-top: -100px;
    margin-left: -200px;
}
</style>
<?php
require_once('database.php');	
$sql="select email,amount from rt_payment where txnid='".$_GET['txnid']."'";
$execute=mysqli_query($conn,$sql);

$result=mysqli_fetch_assoc($execute);

$query_data="SELECT * from rt_coursedescription WHERE rt_coursename = '".$_GET['coursename']."'"
$execute_data=mysqli_query($conn,$query_data);

$result_data=mysqli_fetch_assoc($execute_data);
?>
<div class='row'  id ='centerdiv'>


<div class='row-md-12 row-xs-12'>	
<center>Hi Customer,</center>
</div>
<div class='row-md-12 row-xs-12'>	
<center>We Have received your order with transaction number:<?php echo $_GET['txnid'];?>
<br>coursename:<?php echo $_GET['coursename'];?>
<br>Mode:<?php if($result_data['rt_offlineprice']==$result['amount'])
{ echo "offline"; } else { echo "online"; }?></center>
</div>

<div class='row-md-12 row-xs-12'>	
<center>Thank you for the order.</center>
</div>

</div>
	
	<?php

$msg = "Hi \n You have successfully applied to course from ratheory below are the details";

foreach ($_GET as $key => $value) 
	{
		$enquiry_data[$key] = $value;
		$msg .= "\n".$key.":".$value;
	}

$email=$result['email'];
$headers = "From: contact@raytheory.com";
$msg.="\n amount=".$result['amount'];

mail($email,"RayTheory Course Payment Sucessfully",$msg,$headers);

$query="update rt_payment set status='1' where txnid='".$_GET['txnid']."'"; 	
mysqli_query($conn,$query);


     ?>