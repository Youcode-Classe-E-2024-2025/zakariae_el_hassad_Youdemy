const email_Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const password_Regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^\w\s]).{8,}$/;

function validateForm() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value; 
  const confirmPassword = document.getElementById('confirm_password').value;

  if (!email_Regex.test(email)) {
    alert("Veuillez entrer un email valide.");
    return false;
  }

  if (!password_Regex.test(password)) { 
    alert("Le mot de passe doit comporter au moins une lettre, un chiffre, et un caractère spécial, et avoir une longueur minimale de 8 caractères.");
    return false; 
  }

  if (password !== confirmPassword) {
    alert("Les mots de passe ne correspondent pas.");
    return false;
  }

  return true; 
}

