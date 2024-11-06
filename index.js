function obtenerPersonaje() {
    return fetch("https://rickandmortyapi.com/api/character/2")
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud');
            }
            return response.json();
        })
        .then(data => {
            console.log('Personaje recibido:', data);
            return data; 
        })
        .catch(error => {
            console.error('Hubo un error al obtener el personaje:', error);
        });
}

function enviarPersonaje(name) {
    return fetch('http://127.0.0.1:8000/personaje', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':'{{csrf_token}}'
        },
        body: JSON.stringify({
            name: name,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Personaje guardado:', data);
    })
    .catch(error => {
        console.error('Error al guardar el personaje:', error);
    });
}

document.querySelector('button').addEventListener('click', () => {
    obtenerPersonaje() 
        .then(data => {
            if (data) {
                enviarPersonaje(data.name);  
            }
        });
});