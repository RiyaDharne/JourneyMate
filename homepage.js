document.addEventListener("DOMContentLoaded", function () {
    // Add hover effect on service items
    const serviceItems = document.querySelectorAll('.service');

    serviceItems.forEach(item => {
        item.addEventListener('mouseenter', function () {
            item.style.transform = "translateY(-10px)";
            item.style.boxShadow = "0 8px 16px rgba(0, 0, 0, 0.2)";
        });

        item.addEventListener('mouseleave', function () {
            item.style.transform = "translateY(0)";
            item.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
        });
    });

    // Smooth scroll to anchor links (if applicable)
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            target.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
