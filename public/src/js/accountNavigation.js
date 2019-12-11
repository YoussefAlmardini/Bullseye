class BotBarNavigation{

     static navItems =()=> {
      return{
        profile: {
            element : document.getElementById('profile'),
            active : false,
            location : "profiel"
        },
        map:{
            element : document.getElementById('main'),
            active : true,
            location : "main"
        },
        settings:{
            element : document.getElementById('settings'),
            active : false,
            location : "settings"
        },
      }
    }

    static Navigate =(location)=>{
      this.UpdateGraphics(location);
    }

    static UpdateGraphics=(element)=>{

        let nav = this.navItems();

        switch(element){
            case Element.PROFILE:
                    nav.profile.active = true;
                    nav.map.active = false;
                    nav.settings.active = false;
                    this.LoadPage(nav);
                    
                break;
            case Element.MAIN:
                    nav.profile.active = false;
                    nav.map.active = true;
                    nav.settings.active = false;
                    this.LoadPage(nav);
                break;
            case Element.SETTINGS:
                    nav.profile.active = false;
                    nav.map.active = false;
                    nav.settings.active = true;
                    this.LoadPage(nav);
                break;

        }
    }

    static SwitchActivaty=(currentLocation)=>{
        console.log(currentLocation);
       for(let key in this.navItems()){
           if(this.navItems()[key].location == currentLocation){
            this.navItems()[key].element.classList.add('active');
           }else{
            this.navItems()[key].element.classList.remove('active');
           }
       }
    }

    static LoadPage=(nav)=>{
        for(let key in nav){
            if(nav[key].active){

                let nextLocation = nav[key].location;
                let currentUrl = window.location.href;
                let currentLocation = this.GetCurrntLocation(nav,currentUrl);

                //If you are navigate the same page that you are already in.....
                if(currentUrl.includes(nextLocation)){
                    return false;
                }
                //Else replace the  current extention from the url with the new location... for example .../main (will be) .../settings
                else{
                    this.SwitchActivaty(nav);
                    let nextUrl = this.GetNextUrl(currentUrl,currentLocation,nextLocation);
                    window.location.replace(nextUrl);
                }
            }
        }
       
    }

    //Uti
    static GetNextUrl=(Url,currentLocation,nextLocation)=>{
        return Url.replace(currentLocation,nextLocation);
    }
    
    static GetCurrntLocation=(nav,currentUrl)=>{
        for(let key in nav){
            if(currentUrl.includes(nav[key].location)){return nav[key].location;}
        }
    }
}

const Element = {
    PROFILE: 'profile',
    MAIN: 'main',
    SETTINGS:'settings'
}

