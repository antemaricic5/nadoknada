var logirankorisnik;
$(document).ready(function () 
{
    let oneitemview = document.querySelector(".oneimage-view")
    oneitemview.style.display="none"
    
    oneimageviewClick()
    galleryViewClick()
    nickClick()
    getloggedNick()
});
function getloggedNick(){
    $.ajax({
        type:'GET',
        url:'./backend/dohvatiId.php',
        success : function(response){
            var obj = JSON.parse(response);
            logirankorisnik = obj.korisnickoime
        }
    })
}
function nickClick(){
    let wrapper = document.querySelector(".photo-list")
    wrapper.addEventListener("click",function(event){
        if(event.path[1].id == "nadimak"){
            if(event.path[0].innerHTML == logirankorisnik){
                window.location="./profil.php"
            }
            else{
                localStorage.setItem("tudiprofil",event.path[0].innerHTML)
                window.location="./tudiprofil.html"
            }
        }
    })
}
function oneimageviewClick(){
    var oneimgclick = document.querySelector("#oneimageview")
    var gallery = document.querySelector("#galleryview")
    oneimgclick.addEventListener("click",function(){
        oneimgclick.style.borderBottom = "2px solid"
        gallery.style.borderBottom = "none"
        let galleryview = document.querySelector(".gallery-view")
        let oneitemview = document.querySelector(".oneimage-view")
        galleryview.style.display="none"
        oneitemview.style.display ="block"
        oneitemview.style.padding="0 150px"
    })
}
function galleryViewClick(){
    var gallery = document.querySelector("#galleryview")
    var oneimgclick = document.querySelector("#oneimageview")
    gallery.addEventListener("click",function(){
        gallery.style.borderBottom = "2px solid"
        oneimgclick.style.borderBottom = "none"
        let galleryview = document.querySelector(".gallery-view")
        let oneitemview = document.querySelector(".oneimage-view")
        oneitemview.style.display="none"
        galleryview.style.display ="block"
        
        //oneitemview.style.padding="0 150px"
    })
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
function oneimageview(){
    console.log("jednaslika")
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var wrapper = document.querySelector(".photo-list")

var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
wrapper.onclick = function(event){
    if(event.target.nodeName === "IMG"){
        let src = event.path[0].src
        let parentdesc = event.path[0].parentElement
        let description = parentdesc.querySelectorAll("p")[1].innerHTML
        modal.style.display = "block";
        modalImg.src = src;
        captionText.innerHTML = description;
    }
    
}

// Get the <span> element that closes the modal
var span = document.querySelector(".close");

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}