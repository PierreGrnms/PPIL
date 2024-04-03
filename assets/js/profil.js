
async function updateVille(postalCode) {
    try {
        const response = await fetch(`https://vicopo.selfbuild.fr/?code=${postalCode}`);
        const data = await response.json();
        return data.cities.map(item => item.city);
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
}


document.querySelector('#profil_form_code_postal').addEventListener('input', async function (event) {
    const postalCode = event.target.value;
    if (postalCode.length === 5) {
        const cities = await updateVille(postalCode);
        const villeSelect = document.querySelector('#profil_form_ville');
        villeSelect.innerHTML = '';
        cities.forEach((city, i) => {
            villeSelect.options[i] = new Option(city, city);
        });
    }
});

