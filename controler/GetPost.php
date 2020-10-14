<?php 
function getPost(){
$jsonData = trim(file_get_contents("php://input"));
$jsonData = json_decode($jsonData,true);
include_once('./connect.php');



$msql = openCon();


 if(!isset($jsonData['id'])){
    $ids = mysqli_fetch_all($msql->query("SELECT id FROM posts"));
    $data = ['resoult'=>"Nothing To serach",'request'=>$jsonData,'ids'=>$ids];
    header('Content-Type: application/json');
    echo json_encode($data);
    return;
}
$stmt = $msql->prepare('SELECT * FROM posts WHERE id =?');
$stmt->bind_param('s',$jsonData['id'][0]);
 $stmt->execute();
 $resoult =$stmt->get_result();
 $postData = mysqli_fetch_array($resoult);
 $stmt->close();
 $anyError =mysqli_error($msql);



if($postData===null){
    $data = ['resoult'=>"Not Found",'post'=>null,'requestedId'=>$jsonData['id'],'request'=>$jsonData,'error'=>$anyError];
    header('Content-Type: application/json');
    echo json_encode($data);

}else{
    $data = ['resoult'=>"Ok",'post'=>$postData,'error'=>$anyError];
    header('Content-Type: application/json');
    echo json_encode($data);
}

closeCon($msql);


}
?>