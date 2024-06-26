
    // ======= INIT DES VARIABLES ========
        // Mise en place de la liste des dispos
        let lstDispo=new Array();
        // Mise en place de la liste des fichiers
        let lstFichiers = new Array() ;



    // ======= Creation du formulaire =======
        var form = document.createElement("div");
        form.id = "formOffre"

        // === Ajout du titre du formulaire ===
            const titreForm = document.createElement('h2');
            titreForm.textContent = "Ajouter une Offre" ;
            titreForm.style.textAlign = 'center' ;
            form.appendChild(titreForm) ;

        //  === Creation d'un bouton radio button ===
            const option1 = document.createElement('input');
            option1.type = 'radio';
            option1.id = 'Radio1';
            option1.value = 'pret';
            option1.name = 'radio_type';
            const label1 = document.createElement('label');
            label1.textContent = 'Offre de pret';
            label1.htmlFor = 'Radio1';
            const option2 = document.createElement('input');
            option2.type = 'radio';
            option2.id = 'Radio2';
            option2.value = 'service';
            option2.name = 'radio_type';
            const label2 = document.createElement('label');
            label2.textContent = 'Offre de service';
            label2.htmlFor = 'Radio2';
            const container1 = document.createElement('div');
            const container2 = document.createElement('div');
            form.appendChild(container1);
            form.appendChild(container2);
            container1.appendChild(option1);
            container1.appendChild(label1);
            container2.appendChild(option2);
            container2.appendChild(label2);
        // === Gestion du titre de l'offre ===

            const containerTitre = document.createElement('div');
            // Creation d'un input pour le titre
            const titreField = document.createElement('input');
            titreField.type = 'text';
            titreField.id = 'titre';
            titreField.name = 'titre';
            titreField.classList.add('inputForm')
            const labelTitre = document.createElement('label');
            labelTitre.textContent = 'Ajouter un titre a votre offre :';
            labelTitre.htmlFor = 'titre';
            containerTitre.appendChild(labelTitre);
            containerTitre.appendChild(titreField);
            form.appendChild(containerTitre);

        // === Gestion de la description de l'offre ===
            // Creation d'un input pour la description
            const containerDesc = document.createElement('div');
            const descField = document.createElement('textarea');
            descField.classList.add('inputForm') ;
            descField.id = 'desc';
            descField.name = 'desc';
            descField.style.height= '180px'
            const labelDesc = document.createElement('label');
            labelDesc.textContent = 'Ajouter une description a votre offre :';
            labelDesc.htmlFor = 'desc';
            containerDesc.appendChild(labelDesc);
            containerDesc.appendChild(descField);

            form.appendChild(containerDesc);

        // === Gestion du prix de l'offre ===
            // Creation d'un input pour le prix
            const containerPrix = document.createElement('div');

            const prixField = document.createElement('input');
            prixField.type = 'number';
            prixField.id = 'prix';
            prixField.name = 'prix';
            prixField.classList.add('inputForm') ;
            const labelPrix = document.createElement('label');
            labelPrix.textContent = 'Ajouter un prix en florain pour votre offre :';
            labelPrix.htmlFor = 'prix';
            containerPrix.appendChild(labelPrix);
            containerPrix.appendChild(prixField);

            form.appendChild(containerPrix);

        // ============= Gestion des disponibilitees =============
        const containerDispoForm = document.createElement('div');
        containerDispoForm.id = "containerDispoForm"

        // === Gestion titre dispo ===
            const titreDispoForm = document.createElement('h3');
            titreDispoForm.textContent = "Ajouter une Disponibilite" ;
            titreDispoForm.style.textAlign = 'center'
            containerDispoForm.appendChild(titreDispoForm ) ;
        // === Gestion de la date ===
            const containerDateDispo = document.createElement('div')
            containerDateDispo.classList.add('inputDispo')
            const dateField = document.createElement('input');
            dateField.type = 'date';
            dateField.id = 'date';
            dateField.name = 'date';
            const labelDate = document.createElement('label');
            labelDate.textContent = 'Ajouter une date :  ';
            labelDate.htmlFor = 'date';
            containerDateDispo.appendChild(labelDate);
            containerDateDispo.appendChild(dateField);
            containerDispoForm.appendChild(containerDateDispo) ;
        // === Heure debut ===
            const containerHdebutDispo = document.createElement('div')
            containerHdebutDispo.classList.add('inputDispo')
            const hdField = document.createElement('input');
            hdField.type = 'time';
            hdField.id = 'timeH';
            hdField.name = 'timeH';
            const labelHd = document.createElement('label');
            labelHd.textContent = 'Ajouter une heure de depart : ';
            labelHd.htmlFor = 'timeH';
            containerHdebutDispo.appendChild(labelHd);
            containerHdebutDispo.appendChild(hdField);
            containerDispoForm.appendChild(containerHdebutDispo);
        // === Heure Fin ====
            const containerHfinDispo = document.createElement('div')
            containerHfinDispo.classList.add('inputDispo')
            const hfField = document.createElement('input');
            hfField.type = 'time';
            hfField.id = 'timeF';
            hfField.name = 'timeF';
            const labelHf = document.createElement('label');
            labelHf.textContent = 'Ajouter une heure de fin : ';
            labelHf.htmlFor = 'timeF';
            containerHfinDispo.appendChild(labelHf);
            containerHfinDispo.appendChild(hfField);
            containerDispoForm.appendChild(containerHfinDispo) ;
        // === Gestion de l'affichage de la liste des disponibilitees ===
            const containerDispoLst = document.createElement('div');
            containerDispoLst.id = 'containerDispoLst' ;

            containerDispoForm.appendChild(containerDispoLst) ;

        // === Ajout du bouton ===
            const button = document.createElement('button');
            button.textContent = 'Ajouter la disponibilte';
            button.id = 'add_dispo';
            // Ajout d'une classe au bouton (facultatif)
            button.classList.add('btn');
            button.addEventListener('click', AjouterDispo) ;
            containerDispoForm.appendChild(button) ;
        form.appendChild(containerDispoForm) ;
    // ============= Gestion des images =============

        // === GESTION DU BOUTON D'IMPORT (IMG) ===
            const titreImg = document.createElement('h3') ;
            titreImg.textContent = "Ajouter des images a votre offre :"
            form.appendChild(titreImg) ;
            // Création de l'élément input de type fichier
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.id = 'fileInput';
            fileInput.name = 'images[]';
            fileInput.accept = 'image/*';
            fileInput.multiple = true;
            fileInput.style.display = 'none';
            fileInput.addEventListener('change', function() {
                const files = fileInput.files;
                if (files.length > 0) {
                    for (const file of files) {
                        // Créer un objet FileReader
                        const reader = new FileReader();
                        // Définir ce qui se passe lorsque le fichier est chargé
                        reader.onload = function(event) {
                            lstFichiers.push(event.target.result) ;
                            updateImg() ;
                        }
                        reader.readAsDataURL(file);

                    }
                }
            });
            // Création de l'élément label
            const uploadButton = document.createElement('label');
            uploadButton.htmlFor = 'fileInput';

            // Création de l'élément img à l'intérieur du label
            const img = document.createElement('img');
            img.src = '../images/photo_add.png';
            img.alt = 'Importer une image';
            img.id = 'importImg'
            // Ajout de l'image au label
            uploadButton.appendChild(img);

            form.appendChild(fileInput);
            form.appendChild(uploadButton);


        // === GESTION DU CONTENEUR DES IMAGES IMPORT ===
            const containerImage = document.createElement('div');
            containerImage.id = 'imageContainer' ;
            form.appendChild(containerImage) ;


        // === Gestion du bouton d'envois du formulaire ===
            // Création de l'élément bouton
            const buttonSub = document.createElement('button');
            buttonSub.textContent = 'Ajouter l\'offre';
            buttonSub.id = 'sub';
            buttonSub.classList.add('btn');
            buttonSub.addEventListener('click', function(){
                sendAjaxForm("app_ajax_get") ;
            }) ;
            form.appendChild(buttonSub) ;
//===============================
document.body.appendChild(form) ;

/** 
 * Envois les données du formulaire dans une requete Ajax.
 * @param {String} dest
 */
function sendAjaxForm(dest){
    let err = false ;
    if (lstDispo.length == 0 || titreField.value == '' || prixField.value == '') {
        err = true ;
        alert("Les conditions suivantes doivent être vérifiés : \n-Titre\n-Prix\n-Au moins une disponibilite")
    }

    
    if (!err){
        lstDispo.forEach(element => {
            console.log (element) ;
        });
        lstFichiers.forEach(element => {
            console.log (element) ;
        });
        let type ;
        // Recupération de la valeur des radio button
        const radioButtons = document.querySelectorAll('input[name="radio_type"]');
        // Parcourir tous les boutons radio
        radioButtons.forEach(function(radioButton) {
            // Vérifier si le bouton radio est sélectionné
            if (radioButton.checked) {
                // Récupérer la valeur du bouton radio sélectionné
                 type = radioButton.value;
                // Faire quelque chose avec la valeur sélectionnée
            }
        });
        let titre  = titreField.value ;
        let description = desc.value ;
        let prix = prixField.value ;

        // Créer un objet XMLHttpRequest
        var data = {
            titre: titre,
            description: description,
            prix: prix,
            lstDispo: lstDispo,
            lstFichiers: lstFichiers
        };
        
        // URL de destination de la requête AJAX
        var url = "/ajouteruneoffre";
        
        // Envoi de la requête AJAX
        $.ajax({
            type: "POST", // Méthode HTTP à utiliser
            url: url, // URL de destination
            contentType: "application/json", // Type de contenu de la requête
            data: JSON.stringify(data), // Données à envoyer, converties en JSON
            success: function(response) { // Fonction à exécuter en cas de succès
                console.log("Réponse du serveur :", response);
            },
            error: function(xhr, status, error) { // Fonction à exécuter en cas d'erreur
                console.error("Erreur lors de la requête :", error);
            }
        });
    }
}
/**
 * Fonction mettant a jour l'affichage des dispo sur la page
 * 
 */
function updateDispo(){
    while (containerDispoLst.firstChild) {
        containerDispoLst.removeChild(containerDispoLst.firstChild);
    }

    lstDispo.forEach(element => { 
        // pour chaque disponibilite faire :

        // création d'un conteneur 
            const containerDispo = document.createElement('div');
            containerDispo.classList.add('containerDispo')
            //Création du label affichant les données de la dispo
                const paragraphe = document.createElement('label');
                paragraphe.textContent = element[0] + " " + element[1] + "-" + element[2]  ;
            containerDispo.appendChild(paragraphe) ;
            containerDispoLst.appendChild(containerDispo) ;
            containerDispo.addEventListener('click', function() {
                // S'il y a un clique sur le conteneur de la disponibilité, alors on la supprime de la liste et on met à jour l'affichage.
                const index = lstDispo.indexOf(element);
                if (index != -1) {
                    lstDispo.splice(index,1) ;
                    updateDispo() ;
                }else{
                    alert("Erreur lors du retrait d'une disponibilite")
                }
            }) ;
    });
}

/** 
 * Fonction permettant d'ajouter une disponibilite dans la liste des disponibilite en recuperant les donnes des input date timeH et timeF
 */
function AjouterDispo(){
    // Récupérations des inputs
        const conteneur = document.getElementById('containerDispoLst');
        const date = document.getElementById('date')
        const hDebut = document.getElementById('timeH')
        const hFin = document.getElementById('timeF')
    // Vérification que les champs sont bien remplis
        if (date.value == '' || hFin.value == '' || hDebut.value == '' || hFin.value == '') {
            alert("Veuillez corectement remplir la date l'heure de debut et l'heure de fin") ;
        }else{
            if (new Date ('1/1/1999 ' + hDebut.value) > new Date ('1/1/1999 ' + hFin.value)){
                // Si l'heure de fin est inférieur a l'heure de debut
                alert("L'heure de fin est supérieur a l'heure de début.")
            }
            else{
                // Ajout de la dispo dans la liste des dispo
                const dispo = [date.value, hDebut.value, hFin.value] ; 
                lstDispo.push(dispo) ;
                // Remise a zero des input 
                date.value = "" ;
                hFin.value = "" ;
                hDebut.value = "" ;
                // Mise a jour de l'ffichage des dispo
                updateDispo() ;
            }
        }
    
}

function updateImg(){
    // Recupération du conteneur des images
    const imageContainer = document.getElementById('imageContainer');
    while (imageContainer.firstChild) {
        imageContainer.removeChild(imageContainer.firstChild);
    }
    lstFichiers.forEach(element => {
            // Créer du tableau contenant une image et un label
            const imageCont = document.createElement('table');
            const row1 = document.createElement('tr') ;
            const cell1 = document.createElement('td') ;
            cell1.style.textAlign = 'center' ;
            const cell2 = document.createElement('td') ;
            cell2.style.textAlign = 'center' ;
            const row2 = document.createElement('tr') ;
            row1.appendChild(cell1) ;
            row2.appendChild(cell2) ;
            imageCont.appendChild(row1) ;
            imageCont.appendChild(row2) ;
            imageCont.id = 'tabImg';
            // Créer un élément d'image pour chaque fichier chargé
              const imgElement = document.createElement('img');
                imgElement.src = element;
                imgElement.alt = 'Image affichée';
                imgElement.classList.add('uploaded-image');
                imgElement.style.width = '200px'; // Largeur de l'image
                imgElement.style.height = 'auto'; // Hauteur automatique pour maintenir les proportions
                imgElement.addEventListener('click', function() {
                    // Affiche l'image dans une nouvelle fenetre
                    const largeur = imgElement.naturalWidth;
                    const hauteur = imgElement.naturalHeight;
                    const newTab = window.open();
                    if (hauteur > 1000 || largeur > 1000){
                        newTab.document.write('<img src="' + imgElement.src + '" style="width: 50%; height: auto;" />');
                    }else{
                        newTab.document.write('<img src="' + imgElement.src + '" height: auto;" />');
                    }
                });
                // Ajouter l'élément d'image au conteneur d'images
                const lab_del = document.createElement('label');
                lab_del.id = 'delImg'
                lab_del.textContent = "Supprimer la photo"
                lab_del.addEventListener('click', function() {
                    if(imageContainer.hasChildNodes){
                        const index = lstFichiers.indexOf(imgElement.src);
                        // Vérifier si l'élément a été trouvé
                        if (index !== -1) {
                            // Supprimer l'élément à l'index trouvé
                            lstFichiers.splice(index, 1);
                        }
                        imageContainer.removeChild(imageCont);
                        updateImg()
                    }
                });
                // Supprimer le fichier correspondant de la liste des fichiers

                cell2.appendChild(lab_del);
                cell1.appendChild(imgElement);
                imageContainer.appendChild(imageCont);


    });
}
