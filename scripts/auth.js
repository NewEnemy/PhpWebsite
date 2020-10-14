
function validateAndSubmit(e){
    e.preventDefault()
    
    var formElement = document.querySelector('form')
    let form = new FormData(formElement);
    
  


    fetch('/auth',{
        method:'POST',
        body:form
        
    }).then((out)=>{
        out.json().then((out)=>{
            alert(out.message)
            location.reload()
        }
            
        )
    })
    
}