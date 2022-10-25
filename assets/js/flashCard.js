class Card {

    cardFront;
    cardBack;
    input;
    typeQuestion;
    cardContent;

    constructor(cardFront, cardBack, input, typeQuestion) {
        this.cardFront = cardFront;
        this.cardBack = cardBack;
        this.input = input;
        this.typeQuestion = typeQuestion;
        this.cardContent = [];
    }

    validationOfFrontInput() {
        if (this.input.value === '') {
            alert('Type something!');
        } else {
            this.storageFront();
            this.informateTyping();
            this.hide();
            this.clearInput();
            this.stringLimitation();
            return true
        }
    }

    validationOfBackInput() {
        if (this.input.value === '') {
            alert('Type something!');
        } else {
            this.storageBack();
            this.informateTyping();
            this.hide();
            this.clearInput();
            this.stringLimitation();
            return true
        }
    }

    createFront() {
        this.cardFront.innerText = this.input.value;
    }

    createBack() {
        this.cardBack.innerText = this.input.value;
    }

    hide() {
        this.cardBack.classList.toggle('hide');
        this.cardFront.classList.toggle('hide');
    }

    storageFront() {
        this.cardContent.push(this.input.value);
    }

    storageBack() {
        this.cardContent.push(this.input.value);
    }

    returnArray(){
        return this.cardContent;
    }

    informateTyping() {
        if (this.typeQuestion.innerText === "Type the card's back text") {
            this.typeQuestion.innerText = "Type the card's front text";
        } else {
            this.typeQuestion.innerText = "Type the card's back text";
        }
    }
    
    stringLimitation() {
        if (this.input.value.length > 600) {
            this.input.setAttribute('readonly', '');
        } else {
            this.input.removeAttribute('readonly');
        }
    }

    clearInput() {
        this.input.value = '';
    }

    clearCard() {
        this.cardBack.innerText = '';
        this.cardFront.innerText = '';
    }

  
}

const cardFront = document.querySelector('.front');
const cardBack = document.querySelector('.back');
const input = document.querySelector('#input');
const form = document.querySelector('.form');
const typeQuestion = document.querySelector('.type-question');
let typeValidation = 0;


let card = new Card(cardFront, cardBack, input, typeQuestion);


// to call the functions inside the card
form.addEventListener('submit', (event) => {

    event.preventDefault();
    if (typeValidation === 0) {

        let validation = card.validationOfFrontInput();
        if (validation) {
            typeValidation++;
        }

    } else if (typeValidation === 1) {

        let validation = card.validationOfBackInput();

        if (validation) {
            card.clearCard();

            //showing the card on the right-side of the window

            showCard();
            typeValidation--;
        }
    }
})

// to display along with the typing
input.addEventListener('input', () => {

    if (typeValidation === 0) {
        card.createFront();
        card.stringLimitation();

    } else if (typeValidation === 1) {
        card.createBack();
        card.stringLimitation();
    }
});



const showingFront = document.querySelector('#showing-front');
const showingBack = document.querySelector('#showing-back');
const submiting = document.querySelector('.submiting');
const btnEdit = document.querySelector("#btn-edit");
const btnSave = document.querySelector("#btn-save");

btnEdit.addEventListener('click', () => {

    showingFront.removeAttribute('readonly');
    showingBack.removeAttribute('readonly');
    showingFront.focus();
    showingBack.style.border = '0.2vw solid #44aa44';
    showingFront.style.border = '0.2vw solid #44aa44';
    
})

function showCard() {

    form.classList.toggle('hide');
    submiting.classList.toggle('hide');
    btnSave.focus();

    let front = card.returnArray()[0];
    let back = card.returnArray()[1];
    showingFront.value = front;
    showingBack.value = back;
    
}

showingBack.addEventListener('input', () => {

    if (showingBack.value.length > 600) {
        showingBack.setAttribute('readonly', '');
    } else {
        showingBack.removeAttribute('readonly');
    }

});

showingFront.addEventListener('input', () => {

    if (showingFront.value.length > 600) {
        showingFront.setAttribute('readonly', '');
    } else {
        showingFront.removeAttribute('readonly');
    }

});