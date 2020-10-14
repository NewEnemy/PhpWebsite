
<?php
function BlogPill($blogPost){

   
    $page =file_get_contents('./htmlPages/BlogPill.html');
    $page = str_replace("%title%",$blogPost['title'],$page);
    $page = str_replace("%date%",$blogPost['date'],$page);
    $page = str_replace("%shortText%",$blogPost['shortText'],$page);
    return($page);

}
?>