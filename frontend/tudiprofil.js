var userid;
var span,modal,modalImg,captionText
$(document).ready(function () 
{
    loadData();
    setTimeout(function(){
 // Get the modal
    modal = document.getElementById("myModal");
    modalImg = document.getElementById("img01");
    captionText = document.getElementById("caption");
    span = document.querySelector(".close");
    span.onclick = function() {
        modal.style.display = "none";
      }
    }, 500);
});
function loadData(){
    
    $.ajax({
        type: "POST",
        data:{korisnickoime:localStorage.getItem("tudiprofil")},
        url: "./backend/dohvatikorisnika.php",
        success:function(response){
            console.log(response)
            var obj = JSON.parse(response);
            loadphoto(obj.id)
            document.querySelector("h1").innerHTML = obj.korisnickoime
            document.querySelector("#userimg").src = "./uploads/"+obj.slika
            document.querySelector("p").innerHTML = "<b>"+obj.aktivnost+"<b>"
            if(obj.aktivnost == "offline")
                document.querySelector("p").style.color="red"
            else
                document.querySelector("p").style.color="green"

        }
    });
}
function loadphoto(userid){
    $.ajax({
        type: "POST",
        data:{id:userid},
        url: "./backend/dohvatiSveJavneSlikeKorisnika.php",
        success:function(response){
            document.querySelector(".fish-list").innerHTML = response
        }
    });
}

function logout(){
    $.ajax({
        type:'GET',
        url:'./backend/logOut.php',
        success : function(response){
            window.location="./index.php"
        }
    })
}


// Get the image and insert it inside the modal - use its "alt" text as a caption
var wrapper = document.querySelector(".fish-list")

wrapper.onclick = function(event){
   
    if(event.target.nodeName === "IMG"){
        let src = event.path[0].src
        let parentdesc = event.path[0].parentElement
        let description = parentdesc.querySelector("p").innerHTML
        modal.style.display = "block";
        modalImg.src = src;
        captionText.innerHTML = description;
    }
    
}

// Get the <span> element that closes the modal
// When the user clicks on <span> (x), close the modal
