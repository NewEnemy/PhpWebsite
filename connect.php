<?php 
function openCon()
{
    $dbhost = "localhost";
    $dbuser= "root";
    $dbpass = "";
    $db = "website";
    $port="3306";

    $msqli = new mysqli($dbhost,$dbuser,$dbpass,$db,$port);
    if($msqli->connect_errno){
        echo "Failed to connect to Msql";

    }else{
        
       
    }
    return $msqli;
}

function closeCon($conn){
    $conn->close();

}

?>