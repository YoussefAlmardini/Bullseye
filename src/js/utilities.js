class Uitilities{

     static DetectMobile=()=> {
        if(window.innerWidth > 1000){
            alert("Applicatie is niet beschikbaar in web browser. gebruik uw telephoon om goed gebruik van de applicatie te kunnen maken.");
            location.reload();
        }
     }
}