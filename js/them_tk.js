document.addEventListener("DOMContentLoaded", function () {
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");
  const submitButton = document.getElementById("loginButton");

  function checkInput() {
    if (
      usernameInput.value.trim() === "" &&
      passwordInput.value.trim() === ""
    ) {
      submitButton.disabled = true;
    } else {
      submitButton.disabled = false;
    }
  }

  usernameInput.addEventListener("input", checkInput);
  passwordInput.addEventListener("input", checkInput);
  checkInput();
});
