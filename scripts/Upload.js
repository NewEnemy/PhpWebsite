function validateForm(){
let error=false;
   var formData= $('#uploadForm').serializeArray();
   formData.forEach(item=>{
      
       if(item.name!='comment'){
           if(item.value.length==0){
               error=true;
           }
       }
   })
  if(error){return false}else{return true}
}

function uploadForm(){
   //document.getElementById('uploadForm').submit()
   let form = document.getElementById('uploadForm');
    let formData = new FormData(form);
    fetch('/upload',{
        method:'POST',
        body:formData
        
    })

}

function validateAndUpload(){
    //validateForm()?console.log("all Ok"):alert("Some Fields are required")
    uploadForm()
}