
  //khai báo biến slideIndex đại diện cho slide hiện tại
  var slideIndex;
  // KHai bào hàm hiển thị slide
  function showSlides() {
      var i;
      var slides = document.getElementsByClassName("slide");
      var btn = document.getElementsByClassName("btn");
      for (i = 0; i < slides.length; i++) {
         slides[i].style.display = "none";
      }
      for (i = 0; i < btn.length; i++) {
          btn[i].className = btn[i].className.replace(" active", "");
      }

      slides[slideIndex].style.display = "block";
      btn[slideIndex].className += " active";
      //chuyển đến slide tiếp theo
      slideIndex++;
      //nếu đang ở slide cuối cùng thì chuyển về slide đầu
      if (slideIndex > slides.length - 1) {
        slideIndex = 0
      }
      //tự động chuyển đổi slide sau 5s
      setTimeout(showSlides, 5000);
  }
  //mặc định hiển thị slide đầu tiên
  showSlides(slideIndex = 0);


  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
