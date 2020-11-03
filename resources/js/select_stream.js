const east_stream = document.getElementById('east');
const west_stream = document.getElementById('west');
let stream;

east_stream.addEventListener("click", function() {
    document.querySelector('.east').style.display = "block";
    document.querySelector('.west').style.display = "none";
    stream = "East";
    localStorage.setItem("stream", JSON.stringify(stream));
    // console.log(JSON.parse(localStorage.getItem("stream")));
  });

west_stream.addEventListener("click", function() {
    document.querySelector('.east').style.display = "none";
    document.querySelector('.west').style.display = "block";
    stream = "West";
    localStorage.setItem("stream", JSON.stringify(stream));
    // console.log(JSON.parse(localStorage.getItem("stream")));
  });  

  //on refresh  of page
  window.onload = function() {

    if (JSON.parse(localStorage.getItem("stream")) === "East") {
      document.querySelector('.east').style.display = "block";
      document.querySelector('.west').style.display = "none";
    } 
    else if (JSON.parse(localStorage.getItem("stream")) === "West") {
      document.querySelector('.east').style.display = "none";
      document.querySelector('.west').style.display = "block";
    } else {
      document.querySelector('.east').style.display = "block";
      document.querySelector('.west').style.display = "none";
    }
    
};


