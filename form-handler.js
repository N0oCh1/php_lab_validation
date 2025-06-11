
const form = document.getElementById('contactForm');

//escuchando el evento Submit
form.addEventListener('submit', async function(event) {
  const res = grecaptcha.getResponse()
  const response = document.getElementById("response")
  // muestro por consola el callback del captcha de google
  console.log(res)
  event.preventDefault();
    //Al usar event.preventDefault();
    //detienes ese comportamiento automático, lo que te permite:
    //Capturar los datos del formulario manualmente.
    //enviarlos tú mismo
    //Mostrar resultados sin recargar la página.

  const formData = new FormData(form);
  if(res){
    await fetch("validate.php", {
    method: 'POST',
    body: formData
    })
    .then(res=>res.json())
    .then(data => {
      console.log(data)
      if(data.error){
        response.innerHTML=
        data.error.nameErr +"<br>"+ data.error.emailErr +"<br>"+ data.error.numberErr
      }
      else{
        response.innerText = data.message
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
  else{
    response.innerText = "Tienes que hacer el CaptCha"
  }
});