<?php
$conn=new mysqli('localhost','root','','raytheory');
$post_date = file_get_contents("php://input");
$data=json_decode($post_date);
if(!empty($data))
{
$enquiry_data=array();
$msg="Hi raytheory, \nYou have recieved an enquiry. \nPlease find the details below:";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";
foreach ($data as $key => $value) 
{
    $enquiry_data[$key] = $value;
	$msg .= "\n".$key.":".$value;
}
$msg = wordwrap($msg,70);
mail("contact@raytheory.com","RayTheory Enquiry",$msg,$headers);
if(!empty($enquiry_data))
{
	
	$sql="INSERT INTO rt_enquiry(name,email_id, city, mobile_no, enquiry_msg)
		values('".$enquiry_data['name']."','".$enquiry_data['email_id']."','".$enquiry_data['city']."','".$enquiry_data['mobile_no']."',
		'".$enquiry_data['enquiry_msg']."')";
	$saved=mysqli_query($conn,$sql);
			
	if(!empty($saved))
	{
		echo $message="enquiry is saved"; 
	}
	else
	{
		echo $message="enquiry is not saved please try again later";
	}
}
}
?>

