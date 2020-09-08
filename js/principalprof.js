
let myClassesId = document.querySelector("#myClasses");
let contControl = 1;

window.addEventListener("load", function () {

    let accordion = document.createElement("div");
    accordion.classList.toggle('accordion');
    accordion.setAttribute("id", "turmas-collapse");
    myClassesId.appendChild(accordion);

    for (cont = 1; cont <= 5; cont++) {
        let card = createCard(accordion);
        contControl++;
    }
    console.log(myClassesId);

});


function createCard(accordion) {
    let card = document.createElement("div");
    card.classList.add("card");
    accordion.appendChild(card);

    let cardHeader = document.createElement("div");
    cardHeader.classList.add("card-header");
    createAttributeFunction(cardHeader, "id", `healing${contControl}`);
    card.appendChild(cardHeader);

    let tagButton = document.createElement("button");
    tagButton.classList.add("btn", "btn-link");
    createAttributeFunction(tagButton, "type", "button");
    createAttributeFunction(tagButton, "data-toggle", "collapse");
    createAttributeFunction(tagButton, "data-target", `#collapse${contControl}`);
    createAttributeFunction(tagButton, "aria-expanded", "true");
    createAttributeFunction(tagButton, "aria-controls", `collapse${contControl}`);
    cardHeader.appendChild(tagButton);

    let disciplineTitle = document.createElement("h5");
    disciplineTitle.classList.add("mb-0");
    disciplineTitle.innerHTML = "Rede de Computadores"; // pegar este dado na base
    tagButton.appendChild(disciplineTitle);

    let cardBody = document.createElement("div");
    
    cardBody.classList.add("collapse", "card-body", "buttons-disciplina");
    createAttributeFunction(cardBody, "id", `collapse${contControl}`);
    createAttributeFunction(cardBody, "aria-labelledby", `healing${contControl}`);
    createAttributeFunction(cardBody, "data-parent", "#turmas-collapse");
    card.appendChild(cardBody);
    
    // deve-se modificar para utilizar os dados que contem na baso de dados
    
    let tagDivData = document.createElement("div");
    data(tagDivData, "Curso: ", "Ciência da Computação");
    data(tagDivData, "Dia: ", "Segunda-feira");
    data(tagDivData, "Turno: ", "Noite");
    data(tagDivData, "Código da Turma: ", 8237462387);
    data(tagDivData, "Observações: ", "Essa turma contém alunos do 1 ao 9 periodo");
    cardBody.appendChild(tagDivData);
    
    let buttonLinks = document.createElement("div");
    buttonLinks.classList.add("materia-btn");
    cardBody.appendChild(buttonLinks);

    let TagLinkAFirst = document.createElement("a");
    TagLinkAFirst.classList.add("btn", "btn-outline-dark", "my-2", "my-sm-0", "button-relatorio");
    createAttributeFunction(TagLinkAFirst, "href", "./disciplina.html");
    TagLinkAFirst.innerHTML = "Relatório";
    buttonLinks.appendChild(TagLinkAFirst);

    let TagLinkASecond = document.createElement("a");
    TagLinkASecond.classList.add("btn", "btn-outline-dark", "my-2", "my-sm-0", "button-chamada");
    createAttributeFunction(TagLinkASecond, "href", "./abrirpresenca.html");
    TagLinkASecond.innerHTML = "Chamada";
    buttonLinks.appendChild(TagLinkASecond);
    return;
}
function data(tagDivData, dado, info) { // função que cria os dados de cada disciplina
    let tagB = document.createElement("b")
    tagB.innerText = dado;
    tagDivData.appendChild(tagB);

    let tagSpam = document.createElement("spam")
    tagSpam.innerHTML = info;
    tagDivData.appendChild(tagSpam);

    let tagBr = document.createElement("br");
    tagDivData.appendChild(tagBr);
}

function createAttributeFunction(element, attribute, value) {
    let elementAux = element;
    let attributeAux = document.createAttribute(attribute);
    attributeAux.value = value;
    elementAux.setAttributeNode(attributeAux);
    return element;
}
