function navigate(page) {
    window.location.href = page;
}

document.getElementById("biometricToggle").addEventListener("change", function() {
    alert(this.checked ? "Biometric Authentication Enabled" : "Biometric Authentication Disabled");
});
