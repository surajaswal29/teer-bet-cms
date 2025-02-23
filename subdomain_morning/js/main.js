document.addEventListener("DOMContentLoaded", function () {
  console.log("Sidebar JS Loaded Successfully! 🚀")

  const sidebar = document.getElementById("sidebar")
  const sidebarToggle = document.getElementById("sidebarToggle")
  const sidebarClose = document.getElementById("sidebarToggleClose")

  // Toggle sidebar on button click (only for mobile)
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function (event) {
      if (window.innerWidth < 992) {
        sidebar.classList.toggle("active")
        event.stopPropagation() // Prevents click from propagating
      }
    })
  }

  if (sidebarClose) {
    sidebarClose.addEventListener("click", function () {
      sidebar.classList.remove("active")
    })
  }

  // Click outside to close (only for mobile)
  document.addEventListener("click", function (event) {
    if (
      window.innerWidth < 992 &&
      !sidebar.contains(event.target) &&
      !sidebarToggle.contains(event.target)
    ) {
      sidebar.classList.remove("active")
    }
  })
})
