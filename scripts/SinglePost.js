class PostController{
    constructor(){
        this.allIds = null;
        this.InitData();
    }

    InitData = async()=>{
        let response = await fetch('/get/',{
            method:'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
              },
        
            
            })
           let data = await response.json()
            this.allIds = data.ids
   
    } 

    _getNextIndex(){
        if(this.allIds==null){return}

        let CurrentId = parseInt( $("#mainImage").attr("postId"));

        let currentIndex = this.allIds.findIndex((elem)=>{
          if(parseInt(elem[0])==CurrentId){return true}
          return false
        })
        let nextIndex = currentIndex+1
        if(this.allIds.length-1 < nextIndex){
            return 0
        }
        return nextIndex;

    }
    _getPrevIndex(){
        if(this.allIds==null){return}

        let CurrentId = parseInt( $("#mainImage").attr("postId"));

        let currentIndex = this.allIds.findIndex((elem)=>{
          if(parseInt(elem[0])==CurrentId){return true}
          return false
        })
        let prevIndex = currentIndex-1
        if(prevIndex<0){
            return this.allIds.length-1;
        }
        return prevIndex;

    }


    nextImage(){
      
        let index = this._getNextIndex()
        
        $("#mainImage").attr('postId',this.allIds[index])
        this._getPost(this.allIds[index])

    }
    prevImage(){
        let index = this._getPrevIndex()
        $("#mainImage").attr('postId',this.allIds[index])
        this._getPost(this.allIds[index])
    }




async _getPost(id){
        let that = this;
        const response = fetch('/get',
        {method:"POST",
        mode: "same-origin", // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: "same-origin",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body:JSON.stringify({"id":id})
        
    }
        ).then(function(out){
            
          out.json().then((out)=>that.changeImage(out)
              
          )
          
        })
}

changeImage(postData){
   
    $("#mainImage").attr('src',"/images/"+postData.post.album+"/"+postData.post.fname)
    
    $("#mainImage").attr('postId',postData.post.id)
    $("#title").html(postData.post.title)
}


}


let controller = new PostController();




function getNext(){

    controller.nextImage()
    
}

function getPierv(){

    controller.prevImage()
}
    


    function fullScreen(element){
        console.warn(element.src)
        $(".modial").toggleClass("visible");
        $("#modialImage").attr("src",element.src)
    }

    function exitFullScreen(){
        $(".modial").toggleClass("visible");
        $("#modialImage").attr("src","none")
    }