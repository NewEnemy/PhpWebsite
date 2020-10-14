<?php  




session_start();

$username = strtolower(trim($_POST['username']));
$textPassword = $_POST['password'];
include_once('./connect.php');
$mysql = openCon();

$stm = mysqli_prepare($mysql,'SELECT * FROM users WHERE usernameTrimed=?');

$stm->bind_param('s',$username);

$stm->execute();

$resoult = $stm->get_result();

$userData = mysqli_fetch_assoc($resoult);
$anyError = mysqli_error($mysql);

$errorMessage = ['message'=>'username or password invalid','errorCode'=>'0'];
$succesMessage =  ['message'=>'hello'.$username,'errorCode'=>'0'];




if((mysqli_num_rows($resoult)==0)){
    echo json_encode($errorMessage) ;
}
if(password_verify($textPassword,$userData['pass_hash']) == 1){
$_SESSION['username']= $userData['username'];
$_SESSION['login'] = 'true';
$_SESSION['loginTime'] = time();
echo json_encode($succesMessage =  ['message'=>'Hello  '.$userData['username'],'errorCode'=>'0']);
}






?>