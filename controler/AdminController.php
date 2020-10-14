
<?php

function uploadPost(){
if($_POST['title']===""){
   
    echo "Some Areas are left empty try again <br>";
    print_r($_POST);
    return "error";
}

$album ='';
if(isset($_POST['album'])){
$album=$_POST['album'];
}else{
    $album=$_POST['createAlbum'];
}
$mysql = openCon();

$stm = $mysql->prepare("INSERT INTO posts (title,fname,album,comment,tags) VALUES (?,?,?,?,?)");
$stm->bind_param('sssss',$_POST['title'],$_FILES['file']['name'],$album,$_POST['comment'],$_POST['tags']);

$stm->execute();
echo mysqli_error($mysql);

$stm->close();

$mysql->close();

 




$Types = [
    'image/jpeg'=>[
        'type'=>'image/jpeg',
        'get'=>'imagecreatefromjpeg',
        'save'=>'imagejpeg',
        'ext'=>'.jpg',

    ],
    'image/jpg'=>[
        'type'=>'image/jpg',
        'get'=>'imagecreatefromjpg',
        'save'=>'imagejpg',
        'ext'=>'.jpg',

    ],
    'image/png'=>[
        'type'=>'image/png',
        'get'=>'imagecreatefrompng',
        'save'=>'imagepng',
        'ext'=>'.png',

    ],
    'image/gif'=>[
        'type'=>'image/gif',
        'get'=>'imagecreatefromgif',
        'save'=>'imagegif',
        'ext'=>'.gif',

        ]

];



$thumbnailPath = 'images/thumbnails/'.$album.'/';
if(!is_dir('images/thumbnails/'.$album.'/'))
{mkdir('images/thumbnails/'.$album.'/');}

$hook = $Types[$_FILES['file']['type']];
$image_resource = $hook['get']($_FILES['file']['tmp_name']);


$scaledImage = imagescale($image_resource,400);


$hook['save']($scaledImage,$thumbnailPath.$_FILES['file']['name']);


$targetPath = 'images/'.$album.'/';

$targetPath = $targetPath.basename($_FILES['file']['name']);


if(!is_dir('images/'.$album.'/'))
{mkdir('images/'.$album.'/');}

move_uploaded_file($_FILES['file']['tmp_name'],$targetPath);

imagedestroy($scaledImage);
imagedestroy($image_resource);
}


?>