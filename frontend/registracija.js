var korisnickoime,zaporka,opis,file,filled=false,pass=false;
$(document).ready(function () 
{
    submitUser()
});


function ucitajVarijable(){
    korisnickoime = $("#korisnickoime").val();
    zaporka = $("#zaporka").val();
    opis = $("#opis").val()
    file=$("#file").val();

    provjeraPolja()

    provjeraZaporke();

}
function provjeraPolja(){
    if(korisnickoime=="" || zaporka=="" || opis=="" || file=="" ){
        alert("Molimo Vas popunite sva polja ili učitajte sliku !")
        filled = false
    }
    else{
        filled = true
    }
}
function provjeraZaporke(){
    if(zaporka.length < 6 || !provjeriJelPostojiBroj(zaporka)){
        alert("Zaporka mora imati minimalno 6 znakova i mora sadržavati barem jedan broj !")
        pass=false
    }
    else{
        pass=true
    }

}

function provjeriJelPostojiBroj(word) {
    return /\d/.test(word);
  }
function submitUser(){
    $("#register-form").on('submit', function(e){
        ucitajVarijable();
        e.preventDefault();
        e.stopPropagation();
        console.log(new FormData(this))
        console.log(filled)
        console.log(pass)
        if(filled == true && pass == true ){
            $.ajax({
                type: "POST",
                url: "./backend/registracija.php",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success:function(response){
                    window.location="./index.php"
                }
            });
        }
    });
}
var loadFile = function(event) {
    
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
    $("#tekstnaslici").text("")
  };