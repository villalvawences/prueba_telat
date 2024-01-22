document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('consultarBtn').addEventListener('click', consultarCodigoPostal);

    function consultarCodigoPostal() {
        // Obtén el valor del código postal
        let codigoPostal = document.getElementById('codigo_postal').value;
        let coloniasSelect = document.getElementById('colonia');
        let municipioInput = document.getElementById('municipio');
        let estadoInput = document.getElementById('estado');

        coloniasSelect.innerHTML = '<option value="">Seleccione una colonia</option>';

        // Construye la URL de la API con el código postal
        let apiUrl = `https://api.copomex.com/query/info_cp/${codigoPostal}?token=pruebas`;
        // let apiUrl = `https://api.copomex.com/query/info_cp/${codigoPostal}?token=437d789b-a84a-4275-8ca8-e0c4f092cc30`;

        // Realiza la solicitud a la API
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                coloniasSelect.disabled = false;
                municipioInput.readOnly = true;
                estadoInput.readOnly = true;

                // Agrega opciones al select
                data.forEach(colonia => {
                    var option = document.createElement('option');
                    option.value = colonia.response.asentamiento;
                    option.text = colonia.response.asentamiento;
                    coloniasSelect.add(option);
                });
                // Actualiza los inputs con los datos obtenidos
                // document.getElementById('colonia').value = data[0].response.asentamiento;
                municipioInput.value = data[0].response.municipio;
                estadoInput.value = data[0].response.estado;
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('Error al consultar el código postal. Verifica el código que ingresaste');
            });
    }
});