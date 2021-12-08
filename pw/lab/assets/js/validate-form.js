const form = document.querySelector('#main-form');
const numericInputs = document.querySelectorAll('.numeric-input');

form.addEventListener('submit', (event) => {
    for( let i = 0; i < numericInputs.length; i++ ) {
        const value = numericInputs[i].value;
        const name = numericInputs[i].getAttribute('name');
        if(isNaN(value)) {
            alert(`Error, ${name} debe ser un numero`);
            event.preventDefault();
            break;
        }
    }
});