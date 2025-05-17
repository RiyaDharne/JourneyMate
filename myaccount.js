document.addEventListener('DOMContentLoaded', () => {
    // Mock user data
    const user = {
        name: "Riya Dharne",
        email: "riya31@gmail.com"
    };

    // Update user profile information dynamically
    document.getElementById('user-name').innerText = user.name;
    document.getElementById('user-email').innerText = `********${user.email.slice(-8)}`;

    // Highlight active navigation button
    const navButtons = document.querySelectorAll('.nav-btn');
    navButtons.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            navButtons.forEach(b => b.classList.remove('active'));
            event.target.closest('.nav-btn').classList.add('active');
        });
    });
});
