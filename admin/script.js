document.addEventListener("DOMContentLoaded", function () {
  const hamBurger = document.querySelector(".toggle-btn");
  const sidebar = document.querySelector("#sidebar");
  const sidebarLinks = document.querySelectorAll('.sidebar-link');

  hamBurger.addEventListener("click", function () {
      sidebar.classList.toggle("expand");
  });

  sidebarLinks.forEach(function (link) {
      link.addEventListener('click', function () {
          // Remove 'active' class from all links
          sidebarLinks.forEach(function (otherLink) {
              otherLink.classList.remove('active');
          });

          // Add 'active' class to the clicked link
          link.classList.add('active');
      });
  });
});
