document.addEventListener("DOMContentLoaded", () => {
    const tabButtons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".content");
  
    tabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        // Remove active class from all buttons
        tabButtons.forEach((btn) => btn.classList.remove("active"));
  
        // Hide all content
        contents.forEach((content) => content.classList.add("hidden"));
  
        // Add active class to clicked button and show relevant content
        btn.classList.add("active");
        document.getElementById(btn.getAttribute("data-tab")).classList.remove("hidden");
      });
    });
  });
  // Function to update the current time
function updateTime() {
  const now = new Date();

  // Format the time (hh:mm:ss) and date (dd MMM, yyyy)
  const time = now.toLocaleTimeString('en-US', { hour12: false });
  const date = now.toLocaleDateString('en-US', {
    day: '2-digit',
    month: 'short',
    year: 'numeric',
  });

  // Update the Last Updated time in the DOM
  const lastUpdatedElement = document.getElementById('last-updated');
  lastUpdatedElement.textContent = `${time} ${date}`;
}

// Update the time every second
setInterval(updateTime, 1000);

// Initialize the time when the page loads
updateTime();
