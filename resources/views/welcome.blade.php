<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de personajes de rick and morty...</title>
</head>
<body>
    <button id="guardarPersonaje">Guardar personaje</button>
    <button id="showLista">mostrar lista</button>
    <div id="lista"></div>
</body>
<script>

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
            'X-CSRF-TOKEN':'{{csrf_token()}}'
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

document.querySelector('#guardarPersonaje').addEventListener('click', () => {
    obtenerPersonaje() 
        .then(data => {
            if (data) {
                enviarPersonaje(data.name);  
            }
        });
});

document.querySelector('#showLista').addEventListener('click', () => {

    fetch('http://127.0.0.1:8000/personajes')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los personajes');
            }
            return response.json();
        })
        .then(data => {
            console.log('Personajes obtenidos:', data);
            showResults(data);  
        })
        .catch(error => {
            console.error('Hubo un error:', error);
        });
});


function showResults(personajes) {
    const listaDiv = document.getElementById('lista');
    listaDiv.innerHTML = '';  
    if (personajes.length === 0) {
        listaDiv.innerHTML = '<p>No hay personajes disponibles.</p>';
        return;
    }
    const ul = document.createElement('ul');
    personajes.forEach(personaje => {
        const li = document.createElement('li');
        li.textContent = personaje.name; 
        ul.appendChild(li);
    });

    listaDiv.appendChild(ul);
}


</script>
</html>