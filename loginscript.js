function generateCaptcha() {
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let captcha = "";
    for (let i = 0; i < 4; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById("captchaCode").textContent = captcha;
}

// Refresh CAPTCHA
document.getElementById("refreshCaptcha").addEventListener("click", generateCaptcha);

// Initialize CAPTCHA on page load
generateCaptcha();

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from submitting
    alert('Login form submitted successfully!');
});