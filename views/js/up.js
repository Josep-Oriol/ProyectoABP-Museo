document.addEventListener("DOMContentLoaded", function () {
  const upBtn = document.getElementById("up");

  function up() {
    let scrollPosition = window.scrollY;
    if (scrollPosition >= 120) {
      upBtn.style.display = "flex";
    } else {
      upBtn.style.display = "none";
    }
  }

  window.onscroll = function () {
    up();
  };

  upBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  up();
});
