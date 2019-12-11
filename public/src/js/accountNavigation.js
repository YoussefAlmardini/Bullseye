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
                    this.SwitchActivaty(nav);
                    this.LoadPage(nav);
                    
                break;
            case Element.MAIN:
                    nav.profile.active = false;
                    nav.map.active = true;
                    nav.settings.active = false;
                    this.SwitchActivaty(nav);
                    this.LoadPage(nav);
                break;
            case Element.SETTINGS:
                    nav.profile.active = false;
                    nav.map.active = false;
                    nav.settings.active = true;
                    this.SwitchActivaty(nav);
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
                window.location.replace("http://nlrangers.test/"+nav[key].location);
            }
        }
       
    }
}

const Element = {
    PROFILE: 'profile',
    MAIN: 'main',
    SETTINGS:'settings'
}

