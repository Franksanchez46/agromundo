  document.addEventListener("DOMContentLoaded", function () {
    const loadMoreBtn = document.getElementById("load-more");
    const boxes = document.querySelectorAll("#lista-1 .box");
    let currentIndex = 12; // Ya se muestran 12 al principio

    loadMoreBtn.addEventListener("click", function () {
        let count = 0;

        for (let i = currentIndex; i < boxes.length && count < 8; i++) {
            boxes[i].classList.remove("oculto");
            count++;
        }

        currentIndex += count;

        // Si no quedan más productos, ocultar el botón
        if (currentIndex >= boxes.length) {
            loadMoreBtn.style.display = "none";
        }
    });

    // Si hay 12 o menos productos, ocultar el botón desde el inicio
    if (boxes.length <= 12) {
        loadMoreBtn.style.display = "none";
    }
});
