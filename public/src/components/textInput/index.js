import ElementContainer from '../elementContainer/index.js';

export default class TextInput {

  static Render=(inputType,textChanged)=>{
    return this.CreateInput(inputType,textChanged)
  };

  static CreateInput=(inputType,textChanged)=>{
    let input = document.createElement('input');
    input.type = inputType;
    input.onkeyup = textChanged;
    let element = ElementContainer.Render();
    element.appendChild(input);
    return element;
  }

}