
const login = function()
{
      const username = document.getElementById('demo-name').value;
      const password  = document.getElementById('demo-senha').value;
      if(username == "" | password == "")
      {
          Swal.fire({
              title: 'Por favor informe seu usuario/email e sua senha para continuar!',
              text: '',
              icon: 'info',
            });
            return;
      }
      else
      {
          const url = window.location.href;
          const user = btoa(username);
          const pass = btoa(password);
          ///login/u/{username}/p/{password}
          const uri = url + "login/u/"+ user + "/p/" + pass;
          console.log(uri);
      }
}


const logout = function(){
    
}



const reset = function()
{
    document.getElementById('demo-name').value="";
    document.getElementById('demo-senha').value="";
}


window.onload = function(){
    
    setTimeout(function(){
          document.getElementById('sidebar').classList.add("inactive");
    }, 8000);
  
}