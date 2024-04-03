// Création du formulaire
const noteInput = document.createElement('input');
noteInput.setAttribute('name', 'noteInput');
noteInput.setAttribute('type', 'text');
noteInput.value = 0;
function createForm() {
    const form = document.createElement('form');
    form.classList.add('eval-form');
    const labelTitre =  document.createElement('label');
    labelTitre.textContent = "Ajouter un titre"
    form.appendChild(labelTitre)
    // Création du TextInput
    const titreInput = document.createElement('input');
    titreInput.setAttribute('type', 'text');
    titreInput.setAttribute('name', 'titreInput');
    titreInput.setAttribute('id', 'titreInput');

    titreInput.setAttribute('placeholder', 'TITRE');
    form.appendChild(titreInput);

    const labelDescription =  document.createElement('label');
    labelDescription.textContent = "Ajouter une description"
    form.appendChild(labelDescription);

    // Création du TextArea
    const textArea = document.createElement('textarea');
    textArea.setAttribute('name', 'textArea');
    textArea.setAttribute('placeholder', 'Description');
    form.appendChild(textArea);

    // input de la note


    // Création du div
    const emptyDiv = document.createElement('div');




    function afficherEtoile(note){
        note = parseInt(note)
    switch (note) {
        case 0:
            etoile1.src = '../images/etoile.png';
            etoile2.src = '../images/etoile.png';
            etoile3.src = '../images/etoile.png';
            etoile4.src = '../images/etoile.png';
            etoile5.src = '../images/etoile.png';

            break;
        case 1:
            etoile1.src = '../images/etoileJ.png';
            etoile2.src = '../images/etoile.png';
            etoile3.src = '../images/etoile.png';
            etoile4.src = '../images/etoile.png';
            etoile5.src = '../images/etoile.png';
            break;
        case 2:
            etoile1.src = '../images/etoileJ.png';
            etoile2.src = '../images/etoileJ.png';
            etoile3.src = '../images/etoile.png';
            etoile4.src = '../images/etoile.png';
            etoile5.src = '../images/etoile.png';
            break;
        case 3:
            etoile1.src = '../images/etoileJ.png';
            etoile2.src = '../images/etoileJ.png';
            etoile3.src = '../images/etoileJ.png';
            etoile4.src = '../images/etoile.png';
            etoile5.src = '../images/etoile.png';
            break;
        case 4:
            etoile1.src = '../images/etoileJ.png';
            etoile2.src = '../images/etoileJ.png';
            etoile3.src = '../images/etoileJ.png';
            etoile4.src = '../images/etoileJ.png';
            etoile5.src = '../images/etoile.png';
            break;
        case 5:
            etoile1.src = '../images/etoileJ.png';
            etoile2.src = '../images/etoileJ.png';
            etoile3.src = '../images/etoileJ.png';
            etoile4.src = '../images/etoileJ.png';
            etoile5.src = '../images/etoileJ.png';
            break;
        default:
            etoile1.src = '../images/etoile.png';
            etoile2.src = '../images/etoile.png';
            etoile3.src = '../images/etoile.png';
            etoile4.src = '../images/etoile.png';
            etoile5.src = '../images/etoile.png';
            break;
    }
    }
    //etoile 1
    var etoile1 = document.createElement('img');
    etoile1.src = '../images/etoile.png';

    etoile1.alt = 'etoile1'; // Texte alternatif pour l'etoile1
    etoile1.style.width = '5%'
    etoile1.addEventListener('mouseenter', function() {
        // Code à exécuter lorsque l'image est survolée
        console.log('L\'image est survolée');
        afficherEtoile(1)

    });

    // Ajoutez un écouteur d'événement pour quitter le survol
    etoile1.addEventListener('mouseleave', function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Le curseur a quitté l\'image');
        afficherEtoile(noteInput.value)

    });

    etoile1.onclick = function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Note = 1');
        if(noteInput.value == 1){
            noteInput.value = 0
            afficherEtoile(0)
        }
        else{
            noteInput.value = 1
            afficherEtoile(1)
        }
    };
    //etoile 2
    var etoile2 = document.createElement('img');
    etoile2.src = '../images/etoile.png';

    etoile2.alt = 'etoile2'; // Texte alternatif pour l'etoile1
    etoile2.style.width = '5%'

    etoile2.addEventListener('mouseenter', function() {
        // Code à exécuter lorsque l'image est survolée
        console.log('L\'image est survolée');
        afficherEtoile(2)

    });

    // Ajoutez un écouteur d'événement pour quitter le survol
    etoile2.addEventListener('mouseleave', function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Le curseur a quitté l\'image');
        afficherEtoile(noteInput.value)


    });
    etoile2.onclick = function() {
        // Code à exécuter lorsque le curseur quitte l'image
        if(noteInput.value == 2){
            noteInput.value = 0
            afficherEtoile(0)
        }
        else{
            noteInput.value = 2
            afficherEtoile(2)
        }
    };


    //etoile 3
    var etoile3 = document.createElement('img');
    etoile3.src = '../images/etoile.png';

    etoile3.alt = 'etoile3'; // Texte alternatif pour l'etoile1
    etoile3.style.width = '5%'

    etoile3.addEventListener('mouseenter', function() {
        // Code à exécuter lorsque l'image est survolée
        console.log('L\'image est survolée');
        afficherEtoile(3)

    });

    // Ajoutez un écouteur d'événement pour quitter le survol
    etoile3.addEventListener('mouseleave', function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Le curseur a quitté l\'image');
        afficherEtoile(noteInput.value)


    });
    etoile3.onclick = function() {
        // Code à exécuter lorsque le curseur quitte l'image
        if(noteInput.value == 3){
            noteInput.value = 0
            afficherEtoile(0)
        }
        else{
            noteInput.value = 3
            afficherEtoile(3)
        }
    };

    //etoile 4
    var etoile4 = document.createElement('img');
    etoile4.src = '../images/etoile.png';

    etoile1.alt = 'etoile4'; // Texte alternatif pour l'etoile1
    etoile4.style.width = '5%'

    etoile4.addEventListener('mouseenter', function() {
        // Code à exécuter lorsque l'image est survolée
        console.log('L\'image est survolée');
        afficherEtoile(4)

    });

    // Ajoutez un écouteur d'événement pour quitter le survol
    etoile4.addEventListener('mouseleave', function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Le curseur a quitté l\'image');
        afficherEtoile(noteInput.value)


    });
    etoile4.onclick = function() {
        // Code à exécuter lorsque le curseur quitte l'image
        if(noteInput.value == 4){
            noteInput.value = 0
            afficherEtoile(0)
        }
        else{
            noteInput.value = 4
            afficherEtoile(4)
        }
    };

    //etoile 5
    var etoile5 = document.createElement('img');
    etoile5.src = '../images/etoile.png';

    etoile1.alt = 'etoile5'; // Texte alternatif pour l'etoile1
    etoile5.style.width = '5%'
    let containerEtoiles = document.createElement('div');
    containerEtoiles.classList.add('container-etoiles')
    containerEtoiles.appendChild(etoile1)
    containerEtoiles.appendChild(etoile2)
    containerEtoiles.appendChild(etoile3)
    containerEtoiles.appendChild(etoile4)
    containerEtoiles.appendChild(etoile5)
    form.appendChild(containerEtoiles)

    etoile5.addEventListener('mouseenter', function() {
        // Code à exécuter lorsque l'image est survolée
        console.log('L\'image est survolée');
        afficherEtoile(5)

    });

    // Ajoutez un écouteur d'événement pour quitter le survol
    etoile5.addEventListener('mouseleave', function() {
        // Code à exécuter lorsque le curseur quitte l'image
        console.log('Le curseur a quitté l\'image');
        afficherEtoile(noteInput.value)


    });
    etoile5.onclick = function() {
        // Code à exécuter lorsque le curseur quitte l'image
        if(noteInput.value == 5){
            noteInput.value = 0
            afficherEtoile(0)
        }
        else{
            noteInput.value = 5
            afficherEtoile(5)
        }
    };
    // Création du bouton de soumission
    const submitButton = document.createElement('button');
    submitButton.textContent = 'Ajouter l\'évaluation';
    submitButton.id = 'sub';
    submitButton.classList.add('btn');
    submitButton.addEventListener('click', function(){
        sendAjaxForm("app_ajax_get") ;
    }) ;
    form.appendChild(submitButton);

    return form;
}


/**
 * Envois les données du formulaire dans une requete Ajax.
 * @param {String} dest
 */
function sendAjaxForm(dest){
    let err = false;
    event.preventDefault()
    titre = document.querySelector('#titreInput').value
    note = noteInput.value
    description = document.querySelector('textarea').value
    var url = new URL(window.location.href);
    var id = url.searchParams.get('id');
    
    if (!err){
        // URL de destination de la requête AJAX

        var data = {
            titre: titre,
            description: description,
            note: note,
            id: id,
        };
        $.ajax({
            url: "/offres/evaluation",
            type: 'POST',
            data: JSON.stringify(data),
            processData: false,
            contentType: false,
            success: function(response) {
                closePopup()
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs si nécessaire
                console.error(xhr.responseText);
            }
        });
    }
}


function popUp() {

    let modal = document.createElement('div');
    modal.className = 'pop-up';

    modal.innerHTML = `
        <div class="container-pop">
            <span class="close-btn" onclick="closePopup()">&times;</span>
                <h2>Formulaire</h2>
        </div>
    `;
    document.body.appendChild(modal);

    document.querySelector('.container-pop').appendChild(createForm());

}

function closePopup() {
    var modal = document.querySelector('.pop-up');
    document.body.removeChild(modal);
}