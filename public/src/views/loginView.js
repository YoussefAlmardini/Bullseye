import TextInput from '../components/textInput/index.js';
import Button from '../components/button/index.js';
import ViewContainer from '../components/viewContainer/index.js'; 
import {InputTypes,ButtonTypes} from '../uti/types.js';

export default class LogInView{

    static Render=()=>{
      this.Append(this.CreateComponents(login,emailChange,passwordChange));
    };

    static CreateComponents=(onLogin,emailChange,passwordChange)=>{
      //params(Input Yype,Event)
      let email = TextInput.Render(InputTypes.Text,emailChange);
      let password = TextInput.Render(InputTypes.Password,passwordChange);
      let button = Button.Render(ButtonTypes.LogIn,onLogin);

      return [
        email,
        password,
        button
      ];
    };

    static Append=(elements)=>{

      let container = ViewContainer.Render();

      elements.forEach(element=>{
        container.appendChild(element);
      })

      document.body.appendChild(container);
    };
}
//LogInEvent
const login=()=>{
  alert('uu');
};

const emailChange =(e)=> {
  console.log(e.target.value);
};

const passwordChange =(e)=>{
  console.log(e.target.value);
};