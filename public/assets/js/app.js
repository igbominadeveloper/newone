function generateCode() {
  /**Replace this function block with logic for retrieving the generated code from the server */
  let generateCode = document.querySelector('.generated-code');

  axios.get('/generate')
      .then(response => generateCode.innerHTML = response.data)
      .catch(error => console.log(error))
}

function validateCode(e) {
    let validatedCodeStatus = document.querySelector(".validated-code-status");
  e.preventDefault();
  let data = e.target.previousElementSibling.value;
  if(!data){
    return validatedCodeStatus.innerHTML = "Please input the token first";
  }
  let token = {
    otp: data
  }
    axios.post('/verify',token)
        .then(response => validatedCodeStatus.innerHTML = response.data.message)
        .catch(error => validatedCodeStatus.innerHTML = error.response.data.error)
}