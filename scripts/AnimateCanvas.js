
      document.getElementById("myCanvas").width =window.innerWidth 
      window.onresize = ()=>{
          console.log("resize")
        document.getElementById("myCanvas").width =window.innerWidth 
        document.getElementById("myCanvas").height =document.getElementById("Header").offsetHeight
      }
      window.onmousedown = ()=>{
      
          
      }
      let mainloop



      class AnimatedShapes{
        constructor(canvas,context,startPos,bouncing=true){
            this.pos = startPos;
            this.bounce = bouncing
            this.initiaSpeed = {x:1,y:1}

            this.gravityDirection = 1
            this.xDirection = -Math.random()<0.5?-1:1
            
            this.Vol = Math.random()*2
            this.brightnes = 255
            this.initialColor = `rgba(${Math.random()*this.brightnes}, ${Math.random()*this.brightnes}, ${Math.random()*this.brightnes}, ${Math.random()*0.1})`
            this.size = Math.random()>0.3?0.2+Math.random()*10:0.2+Math.random()*60
            this._directionY = true
            this._directioX = true
            this.random = 1
            this.initialSize = this.size
            this.animatedSize = this.size
            this.animatedSizeDirection = true
            this.animatedSizeRate = Math.random()*0.01+this.size*0.001


            this._applyRandomSpeed()
        }

        getPos =()=>{
            return(this.pos)
        }
        move = ()=>{
            
            if(this.pos.y<0+this.size&&this.gravityDirection==-1){
               this._changeDirectionY()
            }
            if(this.pos.y>canvas.height-this.size&&this.gravityDirection==1){
               
                this._changeDirectionY()
            }

            if(this.pos.x<0+this.size&&this.xDirection==-1){
               
                this._changeDirectionX()
            }
            if(this.pos.x>canvas.width-this.size&&this.xDirection==1){
                this._changeDirectionX()
            }

          
            this.pos.x += this.initiaSpeed.x*this.xDirection*this.Vol
            this.pos.y += this.initiaSpeed.y*this.gravityDirection*this.Vol
           
          }
          _applyRandomSpeed(){
            this.initiaSpeed = {x:Math.random()*0.2,y:Math.random()*0.2}
          }

          _changeDirectionY=()=>{
            this._directionY = !this._directionY
            this.gravityDirection = this._directionY?1:-1

          }
          _changeDirectionX=()=>{
            this._directionX = !this._directionX
            this.xDirection = this._directionX?1:-1
         
          }

          changeSize=()=>{
              

              if(this.animatedSize<0.2&& this.animatedSizeDirection){
                  this.animatedSize=0.2
                  this.animatedSizeDirection=!this.animatedSizeDirection
                  this.initialColor = `rgba(${Math.random()*this.brightnes}, ${Math.random()*this.brightnes}, ${Math.random()*this.brightnes}, ${Math.random()*0.4})`
                 this._applyRandomSpeed()
            }
            
            if(this.animatedSize>this.initialSize&& !this.animatedSizeDirection){
                this.animatedSize=this.initialSize

                this.animatedSizeDirection=!this.animatedSizeDirection

          }
              this.animatedSize+= (this.animatedSizeDirection?-1:1)*this.animatedSizeRate
              this.size = this.animatedSize
           
          }
        
      }

      class Circle extends AnimatedShapes{
  
  
     
          draw = (context)=>{
           
            this.changeSize()
            context.beginPath();
            context.arc(this.pos.x,this.pos.y,this.animatedSize,0,2*Math.PI,false)
            context.fillStyle = this.initialColor
            context.fill()
            
          }
      }




      var canvas = document.getElementById('myCanvas');
      var context = canvas.getContext('2d');

      let AimatedObj=[]
      for (let i = 0; i < 500; i++) {
          let randomX = Math.ceil(Math.random()*window.innerWidth)
          let randomY = Math.ceil(Math.random()*window.innerHeight/6)
        AimatedObj.push(new Circle(canvas,context,{x:randomX,y:randomY}))
          
      }
      mainloop = setInterval(()=>{
        
       
        requestAnimationFrame(()=>{
            context.fillStyle = "black"
            context.clearRect(0, 0, canvas.width, canvas.height);
       
         AimatedObj.forEach(element => {

             element.draw(context)
             element.move()
         });
      })},10)