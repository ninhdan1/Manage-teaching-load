document.addEventListener("DOMContentLoaded", function () {
  const showPasswordButtons = document.querySelectorAll(".show-password");
  showPasswordButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      const passwordCell =
        this.parentElement.parentElement.querySelector(".password-cell");
      const originalPassword = passwordCell.dataset.password; // Lấy mật khẩu từ thuộc tính data-password

      // Tạo một thẻ <i> chứa biểu tượng con mắt
      const eyeIcon = document.createElement("i");
      eyeIcon.classList.add("fa", "fa-eye-slash");

      // Kiểm tra trạng thái của mật khẩu
      if (passwordCell.textContent === originalPassword) {
        passwordCell.textContent = "*".repeat(originalPassword.length);
      } else {
        passwordCell.textContent = originalPassword; // Hiển thị mật khẩu thực sự
      }
    });
  });
});
