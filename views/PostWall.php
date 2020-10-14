<?php

include_once('./views/Post.php');

include_once('./connect.php');
$msql = openCon();
$resoult = $msql->query("Select * From posts");
$numOfResoults = mysqli_num_rows($resoult);
$postData =  mysqli_fetch_all($resoult);
closeCon($msql);


$columns = 2;
$postPerColumn = ceil($numOfResoults/$columns);
$counter = 0;
$blogPost = [['title'=>'First Blog Post','date'=>'22-10-1000','shortText'=>'Is that a first blog post ?'],
['title'=>'Another Blog Post','date'=>'22-10-1000','shortText'=>'Is that a first blog post ?']];
$post =0;










echo '<div class="postContiner" onclick ="openPost(event)">';


echo '<div class="postWraper">';

for ($i=0; $i <$columns ; $i++) { 
    echo '<div class="postColumn">';

  
    for ($j=0; $j <$postPerColumn ; $j++) { 
        $post = null;
            if( $i==0&&$j==0){
                $post = current($postData);
            }else{
                $post = next($postData);
                if($post==null){break;}
            }
          
         echo  Post($post);
        }

        
    

        echo '</div>';

}

echo '</div>';
echo '</div>';



echo '<div class="blogWrapper">
<h1 class="blogColumnTitle">Recent Blog Posts</h1>';

echo '</div>';

?>