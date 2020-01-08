class Question{

    constructor(question,type){
        this.question = question;
        this.type = type;
        this.questionBlock = document.createElement('div');
        this.questionBlock.id = "questionElement";
        this.givenAnswer = '';
        this.answerForm = document.createElement('form');
        this.answerForm.appendChild(this.questionBlock);
        this.answerForm.method = 'post';
        this.answerForm.action = 'main';
    }

    CreateQuestionElement=()=>{

        let questionTitle = document.createElement('p');
        let answerBlock = document.createElement('div');
        let submitBlock = document.createElement('div');

        let answer = document.createElement('input');
        let submit = document.createElement('input');
        answer.type = this.type;
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

        return ( this.questionBlock);
    }

    Print=()=>{document.body.appendChild(this.answerForm);}

    ChangeAnswer=(e)=>{this.givenAnswer = e.target.value;}
    SubmitAnswer=()=>{
        
    }

    Delete=()=>{
        this.questionBlock.innerHTML = '';
    }
}