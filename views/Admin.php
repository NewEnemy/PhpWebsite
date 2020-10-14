<div class="adminPanelBody">
<link rel="stylesheet" href="/css/AdminStyle.css"> 



    <?php 



session_start();

if(!isset($_SESSION['login'])){
    include('./views/LoginForm.php');
    return ;
}

if((time() -$_SESSION['loginTime'])>180){
    session_destroy();
}



include_once('./connect.php');
#echo password_hash("simplePassword",1);

$msql = openCon();
$resoult = $msql->query("Select * From posts");
$GLOBALS['postData'] =  mysqli_fetch_all($resoult);
$resoult = $msql->query("Select DISTINCT album from posts");
$albums = mysqli_fetch_all($resoult);
$GLOBALS['albums']=$albums;
closeCon($msql);
?>

    <div class="adminAllPosts">
        <h1 style="text-align: center;">All Posts</h1>
        <?php 


foreach ($GLOBALS['postData'] as $item) {
    
   echo <<<EOT

    <div class="adminItemWreaper">
    <div>
    <p>ID: $item[0]</p>
    <p>Title : $item[1]</p>
    
    </div>
    <div>
    <p>FileName: $item[2]</p>
    <p>Album: $item[3]</p>
    <img src="images/thumbnails/$item[3]/$item[2]"></img>
    <p>Date: $item[5]</p>
    <p>Likes $item[6]</p>
    <p>Dislikes: $item[7]</p>
    <p>Meh: $item[8]</p>
    <p>Tags $item[9]</p>
    </div>
    <div class="adminButtonWraper">
    <button style="background-color:red;">Remove</button>
    <button style="background-color:lightblue;">Edit</button>
    </div>

    
    </div>

    EOT;
}


?>

    </div>
    <div class="uploadFormWraper">

        <form id="uploadForm" onsubmit="return false" action="/upload" method="POST" enctype='multipart/form-data'>
            <label for="uploadTitle">Title</label>
            <input type="text" id="uploadTitle" name="title" placeholder="Title">
            <br>
            <label for="uploadFile">Select Image</label>
            <input type="file" id='uploadFile' name="file" accept="image/*">
            <br>

            <label>Select Album</label>
            <?php
  foreach ($GLOBALS['albums'] as $album) {
      echo <<<EOT
        <input type="radio" id="$album[0]" name="album" value="$album[0]">
        <label for="$album[0]">$album[0]</label>
      EOT; 
  }
  ?>
            <br>
            <label for="uploadAlbum">Or create album</label>
            <input type="text" name="createAlbum" id="uploadAlbum" placeholder="Album name">

            <br>
            <p>Add comment</p>
            <textarea type="text" name="comment" id="uploadComment" placeholder="Comment/Discription"></textarea>
            <br>
            <p>Tags</p>
            <textarea name="tags" id="uploadTags" cols="3" rows="1"></textarea>
            <br>
            <div class="adminButtonWraper" style="text-align: center;margin:10px;">
                <button id='submitButton' onclick="validateAndUpload()"
                    style="background-color:lightgreen;color:black;">Upload</button>
            </div>
        </form>
    </div>
    <script src="/scripts/Upload.js"></script>
</div>