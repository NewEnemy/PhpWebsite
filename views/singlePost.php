<?php

   function singlePost($item){

   
   $msql = openCon();
   $stmt= $msql->prepare('SELECT * FROM posts WHERE id=?');
   $stmt->bind_param('s',$item);
   $stmt->execute();
    $post = mysqli_fetch_array($stmt->get_result());


    $stmt->close();
    closeCon($msql);

    echo '
    
    <div class="modial" onclick="exitFullScreen()">
    <div class="modialImageWraper"><img id="modialImage" src="/a"></img></div>
 
    </div>
    <div class="singlePostWraper">
    <div class="imageWraper">
    <img onclick="fullScreen(this)" postId="'.$post[0].'" id="mainImage"src="/images/'.$post[3].'/'.$post[2].'" >

    <div class="controls">
    <div class="buttonsControls" onclick="getPierv()">«</div>
    <div id="title">'.$post['title'].'</div>
    <div class="buttonsControls" onclick="getNext()">»</div>
    
    </div>
    </div>
    </div>
    <script src="/scripts/SinglePost.js" ></script>
    ';

}
   ?>