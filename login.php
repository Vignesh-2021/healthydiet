<?php
$email=$_POST["email"]; 
$password=$_POST["password"];
$con=mysqli_connect("localhost","root","Koushik@0617", "project1"); 
if(!$con){
die('Could not connect: '.mysqli_connect_error());
}
$query="select * from users where email='$email' and password='$password'"; 
$records=mysqli_query($con,$query); 
if(mysqli_num_rows($records)>=1)
header("Location: index1.html");
else{
echo "wrong";
}
?>