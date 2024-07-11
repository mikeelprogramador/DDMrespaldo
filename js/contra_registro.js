// Este es el script donde podemos visualizar la contraseña made by Juan Castañeda  
document.getElementById('toggle-password').addEventListener('click', function () {
    const passwordInput = document.getElementById('clave');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
  
    // Cambia la imagen del ojo según el estado de la contraseña
    this.src = type === 'password' ? 'img/ojo1.png' : 'img/ojo2.png';
  });
  
  document.getElementById('toggle-confirm-password').addEventListener('click', function () {
    const confirmPasswordInput = document.getElementById('confirm_clave');
    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordInput.setAttribute('type', type);
  
    // Cambia la imagen del ojo según el estado de la contraseña
    this.src = type === 'password' ? 'img/ojo1.png' : 'img/ojo2.png';
  });
  
  function validateForm() {
    var password = document.getElementById("clave").value;
    var confirmPassword = document.getElementById("confirm_clave").value;
    var error = document.getElementById("error");
  
    if (password !== confirmPassword) {
        error.textContent = "Las contraseñas no coinciden.";
        return false;
    }
    return true;
  }