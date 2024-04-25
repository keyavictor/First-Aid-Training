//Toggle Show/Hide Password
const togglePassword = document.querySelector("#togglePasswordCheckBox");
const password = document.querySelector("#password");
togglePassword.addEventListener("click", () => {
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
});
