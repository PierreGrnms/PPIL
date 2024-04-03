

async function updateVille(postalCode) {
/*    Example:
        http://api.geonames.org/findNearbyPostalCodes?lat=47&lng=9&username=demo
            or
    api.geonames.org/findNearbyPostalCodes?postalcode=8775&country=CH&radius=10&username=demo
        This service is also available in JSON format : api.geonames.org/findNearbyPostalCodesJSON?postalcode=8775&country=CH&radius=10&username=demo*/

    try {
        const response = await fetch(`api.geonames.org/postalCodeLookupJSON?postalcode=${postalCode}&country=FR&username=pierregrnms`);
        const data = await response.json();
        return data.postalcodes.map(item => item.placeName);
    } catch (error) {
        console.error('Error:', error);
        return [];
    }
}


document.querySelector('#registration_form_code_postal').addEventListener('input', async function (event) {
    const postalCode = event.target.value;

    if (postalCode.length === 5) {
        const cities = await updateVille(postalCode);
        const villeSelect = document.querySelector('#registration_form_ville');
        villeSelect.innerHTML = '';
        cities.forEach((city, i) => {
            villeSelect.options[i] = new Option(city, city);
        });

    }
});
