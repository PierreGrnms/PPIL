const nomInput = document.getElementById('nom');
const minPrixInput = document.getElementById('min');
const maxPrixInput = document.getElementById('max');
const codePostalInput = document.getElementById('code');
const villeInput = document.getElementById('ville');
console.log("ok")
function fetchFilteredData() {
    const nom = nomInput.value;
    const minPrix = minPrixInput.value;
    const maxPrix = maxPrixInput.value;
    const codePostal = codePostalInput.value;
    const ville = villeInput.value;


    fetch('/appliquer-filtres', {method: 'POST', body: JSON.stringify(
            {"nom":nom, "minPrix":minPrix,"maxPrix":maxPrix,"codePostal":codePostal,"ville":ville}
        )}).then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            rerender(data['offres']);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function rerender(offres) {

    let html="";

    offres.forEach(function(offre) {
        console.log(offre);

        html += `
            <a href="/offre?id=${offre[0]}">
                <div class="userbox">
                    <img src="/images/user.png" alt="user">
                    <h3>${offre[3]}</h3>
                </div>
                <div class="right-info">
                    <div class="info">
                        <h2>${offre[1]}</h2>
                        <div class="florinsContainer">
                            <h3>${offre[2]}</h3>
                            <img src="/images/florain.png" alt="florain">
                        </div>
                    </div>
                    <div class="place">
                        <h5>${offre[4]} ${offre[5]}</h5>
                    </div>
                </div>
            </a>
        `;
    });

    if (offres.length === 0) {
        html += '<h1 class="err-offre">Aucune offres</h1>';
    }
    document.querySelector('.offres').innerHTML = html;
}

villeInput.addEventListener('change', fetchFilteredData);
nomInput.addEventListener('input', fetchFilteredData);
minPrixInput.addEventListener('input', fetchFilteredData);
maxPrixInput.addEventListener('input', fetchFilteredData);
codePostalInput.addEventListener('input', fetchFilteredData);
villeInput.addEventListener('input', fetchFilteredData);
document.querySelector('.filtres').addEventListener('click', a => {
    let e = document.querySelector('.filtres');
    console.log(parseInt(e.style.left.slice(0, -1)));
    if (parseInt(e.style.left.slice(0, -1)) > 10) e.style.left = 0+'%'
    else e.style.left = 33+'%'
});


