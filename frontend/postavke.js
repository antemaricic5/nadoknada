var id;
$(document).ready(function () 
{
    loadData();
});
function loadData(){
    $.ajax({
        type: "GET",
        url: "./backend/dohvatiId.php",
        success:function(response){
            console.log(response)
            var obj = JSON.parse(response);
            id = obj.id
            document.getElementById("output").src="./uploads/"+obj.slika
            document.getElementById("korisnickoime").value= obj.korisnickoime;
            document.getElementById("opis").value= obj.opis;
        }
      });
}

function azurirajpodatke(){
    $("#profile-form").on('submit', function(e){
        ucitajVarijable();
        e.preventDefault();
        e.stopPropagation();
        var forma = new FormData(this)
        forma.append("id",id)
        if(filled == true){
            $.ajax({
                type: "POST",
                url: "./backend/azurirajpodatke.php",
                data: forma,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response == "sucesfully"){
                        window.location="./profil.php"
                    }
                }
            });
        }
    });
}

function ucitajVarijable(){
    korisnickoime = $("#korisnickoime").val();
    zaporka = $("#zaporka").val();
    opis = $("#opis").val()

    provjeraPolja()

    provjeraZaporke();

}
function provjeraPolja(){
    if(korisnickoime=="" || zaporka=="" || opis==""){
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

  var loadFile = function(event) {
    
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
    $("#tekstnaslici").text("")
  };