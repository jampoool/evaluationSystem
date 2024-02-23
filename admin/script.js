const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

// // Get references to elements
// const pageContent = document.getElementById('page-content');

// // Function to load content based on clicked link
// function loadPage(url) {
//     // Perform AJAX request or load content from server
//     // For simplicity, I'll just load content from a static file
//     fetch(url)
//         .then(response => response.text())
//         .then(html => {
//             pageContent.innerHTML = html;
//         })
//         .catch(error => console.error('Error loading page:', error));
// }

// // Event listener for sidebar links
// document.querySelectorAll('.sidebar-link').forEach(link => {
//     link.addEventListener('click', function(event) {
//         event.preventDefault(); // Prevent default link behavior
//         const url = this.getAttribute('href');
//         loadPage(url);
//     });
// });