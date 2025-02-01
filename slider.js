document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelector(".slides");
    const slide = document.querySelectorAll(".slide");
    const prevBtn = document.querySelector(".prev");
    const nextBtn = document.querySelector(".next");
    let currentIndex = 0;

    function showSlide(index) {
       
        const offset = -index * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }

    prevBtn.addEventListener("click", function() {
        currentIndex = (currentIndex === 0) ? slide.length - 1 : currentIndex - 1;
        showSlide(currentIndex);
    });

    nextBtn.addEventListener("click", function() {
        currentIndex = (currentIndex === slide.length - 1) ? 0 : currentIndex + 1;
        showSlide(currentIndex);
    });
});
