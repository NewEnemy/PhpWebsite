
function openPost(event){
  
    if(event.target.id!=""){
        open('/post/'+event.target.id,'_self')
    }
  
}
