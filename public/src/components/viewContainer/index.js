export default class ViewContainer {

    static Render=()=>{
      return this.CreateElement()
    };
  
    static CreateElement=()=>{
      let element = document.createElement('div');
      return element;
    }
  
  }