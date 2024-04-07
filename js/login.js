const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const loginButton = document.getElementById("loginButton");
usernameInput.addEventListener("input", ButtonState);
passwordInput.addEventListener("input", ButtonState);

function ButtonState() {
  if (usernameInput.value.trim() !== "" && passwordInput.value.trim() !== "") {
    loginButton.disabled = false;
  } else {
    loginButton.disabled = true;
  }
}
