document.addEventListener("DOMContentLoaded", function(){
    const upBtn = document.getElementById("up");

    upBtn.addEventListener("click", function (){
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
})