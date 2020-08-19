var userid;
$(document).ready(function () 
{
    loadData();
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