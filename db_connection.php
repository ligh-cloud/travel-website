<?php  
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "voyage";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn){
    echo "you are connected" ;

}
else{
    echo "could not cennect" ;
}

?>