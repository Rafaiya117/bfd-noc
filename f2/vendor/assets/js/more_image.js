document.addEventListener("DOMContentLoaded", function() {
    var addMoreBtn = document.getElementById("addMoreBtn");
    var additionalFiles = document.getElementById("additionalFiles");
    var fileCounter = 2; // Starting file counter for additional files
    var maxFiles = 3; // Maximum number of additional files
  
    addMoreBtn.addEventListener("click", function() {
      if (fileCounter <= maxFiles) {
        var fileInput = document.createElement("input");
        fileInput.type = "file";
        fileInput.name = "file" + fileCounter;
  
        var br = document.createElement("br");
  
        additionalFiles.appendChild(br);
        additionalFiles.appendChild(fileInput);
  
        fileCounter++;
      } else {
        alert("Maximum number of files reached.");
      }
    });
  })
