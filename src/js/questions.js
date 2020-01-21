class Question{

    constructor(question,type){
        this.question = question;
        this.type = type;
        this.questionBlock = document.createElement('div');
        this.questionBlock.id = "questionElement";
        this.container = document.createElement('div');
        this.container.appendChild(this.questionBlock);
        this.givenAnswer = '';
    }

    CreateQuestionElement=()=>{

        let questionTitle = document.createElement('p');
        let answerBlock = document.createElement('div');
        let submitBlock = document.createElement('div');

        let answer = document.createElement('input');
        let submit = document.createElement('input');
        submit.addEventListener('click', sendAnswer);
        answer.type = this.type;
        answer.id = 'answer';
        submit.innerText = 'Checken';
        submit.type = 'submit';
        answer.name = 'answerBody'
        submit.name = 'answer';

        this.questionBlock.classList.add('questionBlock');

        questionTitle.innerText = this.question;

    
        answer.addEventListener("change", this.ChangeAnswer);
        submit.addEventListener("submit",this.SubmitAnswer);

        answerBlock.appendChild(answer);
        submitBlock.appendChild(submit);

        this.questionBlock.appendChild(questionTitle);
        this.questionBlock.appendChild(answerBlock);
        this.questionBlock.appendChild(submitBlock);

        return ( this.container);
    }

    Print=()=>{document.body.appendChild(this.container);}

    ChangeAnswer=(e)=>{this.givenAnswer = e.target.value;}
    SubmitAnswer=()=>{
        
    }

    Delete=()=>{
        this.container.innerHTML = '';
    }
}