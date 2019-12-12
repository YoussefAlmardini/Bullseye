<div class="standardMain">
    <div class="thirdTitle spaceUnder center">
        Current speurtocht
    </div>

    <div class="scaverageListItem">

        <img src="/src/assets/zoo.png"  class="scaverageListItemIcon">

        <div class="scaverageListItemBody">

            <div  class="thirdTitle center top">
                Dierentuin Amersfoort
            </div>

            <div class="scaverageListItemInfo">
             <div>woensdag 10 Dec tussen 14:00 en 18:00 uur </div>
             <div>locatie:   ingang van dierentuin Amersfoort</div>
            </div>

            <div class="scaverageListItemText">
                Wil je ontdekken wat de dieren
                doen achter de kooi?
                Een fantastisch avontuur met 
                een paar opdrachten!
            </div>

            <div class="mainButton">
                <button class="lightGreen">Start</button>
            </div>
            <div class="mainButton lessSpaceBetween">
                <button onclick="ShowInfo(this)">
                    <div class="popup">Info
                    <span class="popuptext" id="myPopup">
                        <p>Info</p>
                        Er zijn vele variaties van passages van 
                        Lorem Ipsum beschikbaar maar het merendeel 
                        heeft te lijden gehad van wijzigingen
                        in een of andere vorm.
                    </span>
                    </div>
                </button>
            </div>
        </div>

    </div>

</div>
<script>

function ShowInfo(){
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>