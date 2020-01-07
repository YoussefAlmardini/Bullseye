class Mobility{

   //if mobile
     static DetectMobile=()=> {
        if(window.innerWidth > 1024){
            alert("Applicatie is niet beschikbaar in web browser. gebruik uw telephoon om goed gebruik van de applicatie te kunnen maken.");
            location.reload();
        }
     }

     //If Ipad 
     static DetectIpad=()=>{
           return navigator.userAgent.match(/iPad/i) != null;
     }

     static UpdateIpadLayout=()=>{
         if(this.DetectIpad()){
             document.body.style.height = "1590px";
        }
     }

     static PlatformUpdate=()=>{
        this.DetectMobile();
        this.UpdateIpadLayout();
     }

     static InitilizePlatform =()=>{
        window.onload = function() {Mobility.PlatformUpdate();} 
        window.onresize = function(){Mobility.PlatformUpdate();}
     }
}
Mobility.InitilizePlatform();

