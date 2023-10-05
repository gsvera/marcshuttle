
const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
const regexPrice = /^\d+(\.\d+)?$/
const headConexion = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': window.CSRF_TOKEN //the token is create in head html
};
const sizeImgAvailable = 2097152;
const opciones = { year: 'numeric', month: 'numeric', day: 'numeric' };

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

/**
 *  Recibe el nombre del permiso para consultar al backend
 * @param {string} permision 
 * @returns 
 */
async function validPermision(permision) {
    return await new Promise((resolve) => {
        fetch(`/admin-marcshuttle/valid-permision?permiso=${permision}`)
        .then(res => res.json())
        .then(result => {
            if(result.error == false) {
                resolve(result.data);
            }
            else
                return resolve(false);
        })
    }) 
}

/**
 *  Valida el peso del archivo maxico permitido 2MB
 * @param {number} fileSize 
 * @returns 
 */
function validSizeFile(fileSize) {
    if(fileSize > sizeImgAvailable) {
        notification('error', 'Los archivos deben pesar menos de 2MB');
        return false;
    }
    else 
        return true;
}

function changeLenguage(lang){
    var prefij = ''
    if(lang == 'en')
        prefij = 'en'

    $.ajax({
        url: '/changelenguage',
        type: "POST",
        data: {
            "lang": lang
        },
        success: function(result)
        {
            if(result.error == false)
            {
                window.location.href = '/'+prefij
            }
        }
    })
}

function convertCurrency(n){
    let currencyLocal = Intl.NumberFormat('en-US',{style:'currency', currency:'USD'})
    
    return (currencyLocal.format(n))
    
  }

function acceptOnlyPrice(price){
    if(!regexPrice.test(price)) {
        notification('error', 'Ingrese un precio valido');
        return true;
    }
}

function validOnlyPrice(price){
    if(!regexPrice.test(price)) {
        return true;
    }
}

// Funcion para resetear cualquier formulario pasando el id del formulario
function resetForm(idForm){
    idForm.reset();
}

function generarColorRGB() {
    const r = Math.floor(Math.random() * 256); 
    const g = Math.floor(Math.random() * 256); 
    const b = Math.floor(Math.random() * 256); 
  
    return `rgb(${r}, ${g}, ${b})`;
  }