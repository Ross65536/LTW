document.addEventListener('DOMContentLoaded', function() {
  document.getElementById("small_menu").addEventListener('click', function(event) {
    event.stopPropagation();
    var menu = document.getElementById("responsive-dropdown");
    if (menu.style.visibility == 'hidden') {
      menu.style.visibility = 'visible';
    }
    else {
      menu.style.visibility = 'hidden';
    }
  });
});
