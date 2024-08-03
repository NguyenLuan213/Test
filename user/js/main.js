const cartButton = document.querySelectorAll(".cart__button");
cartButton.forEach((button) => {
  button.addEventListener("click", cartClick);
});

function cartClick() {
  let button = this;
  button.classList.add("clicked");
}
// video 
document.addEventListener("DOMContentLoaded", function() {
  const videos = document.querySelectorAll('video');
  
  videos.forEach(video => {
    video.muted = true;
    video.addEventListener('mouseover', function() {
      videos.forEach(vid => {
        if(vid !== video) {
          vid.pause();
        }
      });
      video.play();
    });
  });
});


