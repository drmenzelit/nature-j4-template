document.addEventListener('DOMContentLoaded', function (event) {
  /**
   * Menu toggle
   */
  const menuToggle = document.querySelector("#menu-toggle");
  const menu = document.querySelector("#menu");
  
  // Add an event listener for  
  // a click to the button
  menuToggle.addEventListener("click", function () { 
  
    // Toggle attribute
    menuToggle.setAttribute(
      'aria-expanded',
      menuToggle.getAttribute('aria-expanded') === 'false' 
        ? 'true'
        : 'false'
    )
    menu.classList.toggle("active");

  }); 

});
