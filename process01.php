<?php
session_start();
$mysqli = new mysqli('localhost','root','','crud02') or die(mysqli_error($mysqli));
$id = 0;
$update = false;
$fname = '';
$lname = '';
$email = '';
$age = '';
$location = '';
if(isset($_POST['save']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $location=$_POST['location'];
    $mysqli->query("INSERT INTO data02(fname,lname,email,age,location) VALUES ('$fname','$lname','$email','$age','$location')") or
    die($mysqli->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location:index.php");
   
}
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data02 WHERE id=$id") or die($mysqli->error());
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location:view.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from data02 WHERE id=$id") or die($mysqlie->error());
    //if(count($result)==1)
    {
        $row = $result->fetch_array();
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $age = $row['age'];
        $location = $row['location'];
        
    }    
}

if(isset($_POST['update']))
   {
       $id = $_POST['id'];
       $fname = $_POST['fname'];
       $lname = $_POST['lname'];
       $email = $_POST['email'];
       $age = $_POST['age'];
       $location = $_POST['location'];
    
    $mysqli->query("UPDATE data02 SET fname='$fname',lname='$lname',email='$email',age='$age',location='$location' WHERE id=$id") or
    die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location:index.php");
       
    }

?>