
/* making sure if javascript run contentHolding starts as hiden */
var content2 = document.getElementsByClassName("contentHolding");
     for (i = 0; i < content2.length; i++){
     content2[i].style.display = "none";
     }
var coll = document.getElementsByClassName("collapsible");

for (i = 0; i < coll.length; i++) {
    //if clicked show content or hide
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
