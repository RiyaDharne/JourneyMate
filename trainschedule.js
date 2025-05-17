document.addEventListener("DOMContentLoaded", () => {
  const sortBtn = document.getElementById("sort-by");
  const calendarBtn = document.getElementById("calendar");

  sortBtn.addEventListener("click", () => {
    alert("Sort By button clicked!");
    // Implement sorting logic
  });

  calendarBtn.addEventListener("click", () => {
    alert("Calendar button clicked!");
    // Implement calendar logic
  });

  const classButtons = document.querySelectorAll(".class-btn");
  classButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      alert(`${btn.innerText} button clicked!`);
    });
  });
});
