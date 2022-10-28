const cardFront = document.querySelector('.front');
const cardBack = document.querySelector('.back');
const turnButton = document.querySelector('.turn');
const previous = document.querySelector('.previous');
const next = document.querySelector('.next');
const title = document.querySelector('.title');
const cardConfig = document.querySelector('.card-config');
const cardNumber = document.querySelector('.card-number');
const timeInput = document.querySelectorAll('.time');

let i = 0;


async function gettingJson() {
    let cards = await fetch('../config/reviewCardsFunctional.php');
    cards = await cards.json();
    return cards;
}

async function timeRevision() {
    let cards

    if (timeInput[0].checked) {
        cards = await gettingJson();
        showingCards(cards);
        setGetRequest(cards);
    } else if (timeInput[1].checked) {
        cards = await cards24H();
        showingCards(cards);
        setGetRequest(cards);
    } else if (timeInput[2].checked) {
        cards = await cards7D();
        showingCards(cards);
        setGetRequest(cards);
    } else if (timeInput[3].checked) {
        cards = await cards1M();
        showingCards(cards);
        setGetRequest(cards);
    } else if (timeInput[4].checked) {
        cards = await cards3M();
        showingCards(cards);
        setGetRequest(cards);
    }
    return cards;
}


async function cards24H() {
    let cards = await gettingJson();
    let array = [];
    let date = new Date();

    cards.forEach(card => {
        let timeArray = card.created_at.split(/[-:\s]/);

        let creationDate = (Number(timeArray[0]) - 2022) * 12 * 30 + Number(timeArray[1]) * 30 + Number(timeArray[2]);
        let currentDate = (date.getFullYear() - 2022) * 12 * 30 + (date.getMonth() + 1) * 30 + date.getDate();

        let condition = (currentDate - creationDate > 0 && currentDate - creationDate < 7);

        if (condition) {
            array.push(card)
        }
    });
    return array;
}

async function cards7D() {
    let cards = await gettingJson();
    let array = [];
    let date = new Date();

    cards.forEach(card => {
        let timeArray = card.created_at.split(/[-:\s]/);

        let creationDate = (Number(timeArray[0]) - 2022) * 12 * 30 + Number(timeArray[1]) * 30 + Number(timeArray[2]);
        let currentDate = (date.getFullYear() - 2022) * 12 * 30 + (date.getMonth() + 1) * 30 + date.getDate();

        let condition = (currentDate - creationDate > 6 && currentDate - creationDate < 30);

        if (condition) {
            array.push(card)
        }
    });
    return array;
}

async function cards1M() {
    let cards = await gettingJson();
    let array = [];
    let date = new Date();

    cards.forEach(card => {
        let timeArray = card.created_at.split(/[-:\s]/);

        let creationDate = (Number(timeArray[0]) - 2022) * 12 * 30 + Number(timeArray[1]) * 30 + Number(timeArray[2]);
        let currentDate = (date.getFullYear() - 2022) * 12 * 30 + (date.getMonth() + 1) * 30 + date.getDate();

        let condition = (currentDate - creationDate > 29 && currentDate - creationDate < 90);


        if (condition) {
            array.push(card)
        }
    });
    return array;
}

async function cards3M() {
    let cards = await gettingJson();
    let arrayOfCards = [];
    let date = new Date();

    cards.forEach(card => {
        let timeArray = card.created_at.split(/[-:\s]/);

        let creationDate = (Number(timeArray[0]) - 2022) * 12 * 30 + Number(timeArray[1]) * 30 + Number(timeArray[2]);
        let currentDate = (date.getFullYear() - 2022) * 12 * 30 + (date.getMonth() + 1) * 30 + date.getDate();

        let condition = (currentDate - creationDate >= 90);

        if (condition) {
            arrayOfCards.push(card)
        }
    });

    return arrayOfCards;
}



async function showingCards(cards) {
    cardFront.innerText = cards.length > 0 ? cards[i]['front'] : '';
    cardBack.innerText = cards.length > 0 ? cards[i]['back'] : '';
}


previous.addEventListener('click', async () => {
    if (i > 0) {
        i--;
        cardNumber.innerText = i + 1;
        title.innerText = "card's front";
        cardBack.classList.add('hide');
        cardFront.classList.remove('hide');
        timeRevision();
    }
})

next.addEventListener('click', async () => {
    let cards = await timeRevision()
    if (i < cards.length - 1) {
        i++;
        cardNumber.innerText = i + 1;
        title.innerText = "card's front";
        cardBack.classList.add('hide');
        cardFront.classList.remove('hide');
        timeRevision();
    }

})

turnButton.addEventListener('click', () => {

    if (title.innerText === "card's front") {
        title.innerText = "card's back";
    } else {
        title.innerText = "card's front";
    }

    cardBack.classList.toggle('hide');
    cardFront.classList.toggle('hide');
})

timeInput.forEach (card => {
    card.addEventListener('click', () => {
        cardNumber.innerText = 1
        i = 0;
        timeRevision();
    });
});


function setGetRequest (cards) {
    cardConfig.setAttribute('href', `cardCreation.php?card_id=${cards[i]['card_id'] - 1}`);
} 

async function setNumberOfRevisionCards () {

    const displays = document.querySelectorAll('label>p');

    const allCards = await gettingJson();
    const firstRevisionCards = await cards24H();
    const secondRevisionCards = await cards7D();
    const thirdRevisionCards = await cards1M();
    const fourthRevisionCards = await cards3M();

    console.log(displays)
    displays[0].innerText = allCards.length;
    displays[1].innerText = firstRevisionCards.length;
    displays[2].innerText = secondRevisionCards.length;
    displays[3].innerText = thirdRevisionCards.length;
    displays[4].innerText = fourthRevisionCards.length;

}

setNumberOfRevisionCards();
timeRevision();