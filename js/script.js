const initSlider = () => {
  const imageList = document.querySelector(".slider-wrapper .image-list");
  const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
  const sliderScrollbar = document.querySelector(".container .slider-scrollbar");
  const scrollbarThumb = document.querySelector(".slider-scrollbar .scrollbar-thumb");
  const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

  imageList.style.overflowX = "scroll";
  imageList.style.scrollBehavior = "smooth";


  slideButtons.forEach(button => {
    button.addEventListener("click", () => {
      const direction = button.id === "prev-slide" ? -1 : 1;
      const scrollAmount = imageList.clientWidth * direction;
      imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
  });

  const handleSlideButtons = () => {
    slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
    slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
  }

  const updateScrollThumbPosition = () => {
    const scrollPosition = imageList.scrollLeft;
    const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
    scrollbarThumb.style.left = `${thumbPosition}px`;
  }

  imageList.addEventListener("scroll", () => {
    handleSlideButtons();
    updateScrollThumbPosition();
  });
}

window.addEventListener("load", initSlider);

//home.php

<script>
    $(document).ready(function() {
        $('.image-item').click(function(event) {
            event.preventDefault(); // Prevent default link behavior
            var imageId = $(this).attr('id'); // Get the ID of the clicked image
            // AJAX request to insert order
            $.ajax({
                url: 'insert_order.php',
                method: 'POST',
                data: { image_id: imageId },
                success: function(response) {
                    alert("Order placed successfully!");
                },
                error: function(xhr, status, error) {
                    alert("Error placing order: " + error);
                }
            });
        });
    });
</script>
