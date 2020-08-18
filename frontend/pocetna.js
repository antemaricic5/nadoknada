$(document).ready(function () 
{
    let oneitemview = document.querySelector(".oneimage-view")
    oneitemview.style.display="none"
    
    oneimageviewClick()
    galleryViewClick()
});
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
            window.location="./index.html"
        }
    })
}
function oneimageview(){
    console.log("jednaslika")
}