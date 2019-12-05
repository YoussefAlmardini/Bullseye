import ElementContainer from '../elementContainer/index.js';

export default class Button {

  static Render=(label,click)=>{
    return this.CreateButton(label,click)
  };

  static CreateButton=(label,click)=>{
    let button = document.createElement('button');
    button.innerText = label;
    button.onclick = click;
    button.style.cssText = Styles.button;
    let element = ElementContainer.Render();
    element.appendChild(button);
    return element;
  };
}

const Styles = {
  button: 
  "color: white; " + 
  "border:none; " +
  "background:#0F7EC7; " 
}