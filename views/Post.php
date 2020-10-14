<?php 
include_once('./connect.php');


function Post($item){
       $post = $item;

    
    return '
    
    <div class="post" id="'.$post[0].'">
    <div class="postHeader">
    <h1>'.$post[1].'</h1>
    <p>'.$post[4].'</p>
    </div>
    <img src="/images/thumbnails/'.$post[3].'/'.$post[2].'">
    <div class="postComment">
    <p>'.$post[4].'</p>
    </div>
       
    </div>
    ';}
