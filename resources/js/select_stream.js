const east_stream = document.getElementById('east');
const west_stream = document.getElementById('west');

east_stream.addEventListener("click", function() {
    document.querySelector('.east').style.display = "block";
    document.querySelector('.west').style.display = "none";
  });

west_stream.addEventListener("click", function() {
    document.querySelector('.east').style.display = "none";
    document.querySelector('.west').style.display = "block";
  });  