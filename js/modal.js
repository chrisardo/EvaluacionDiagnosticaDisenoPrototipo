//haciendo aparecer la ventana modal creada

let imagenes = document.querySelectorAll('.gallery__img');
let modal = document.querySelector('#modal');
let img = document.querySelector('#modal__img');
let boton = document.querySelector('#modal__boton');

for(let i = 0; i < imagenes.length; i++)
{
    imagenes[i].addEventListener('click', function(e)
    {
        modal.classList.toggle("modal--open");//agregar ventana modal
        let src = e.target.src;
        img.setAttribute("src", src);

    });

}

//dandole funcionalidad al boton

boton.addEventListener('click', function()
{
    modal.classList.toggle("modal--open");//quitar ventana modal
});