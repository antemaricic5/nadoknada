var id;
$(document).ready(function () 
{
    loadData();
});
function loadData(){
    id = localStorage.getItem("fishId")
    $.ajax({
        type: "POST",
        data:{id:id},
        url: "./backend/ucitajPodatkeRibe.php",
        success:function(response){
            console.log(response)
            var obj = JSON.parse(response);
            document.getElementById('ucitanaslika').innerHTML=obj.slika
            console.log(document.getElementById('file').src)
            document.getElementById("opis").value= obj.opis;
            if(obj.privatnost == "Javno" ) {
                document.getElementById("customRadio_1").checked = true;
            }
            else{
                document.getElementById("customRadio_2").checked = true;
            }
        }
      });
}

function ažurirajpodatkeslike(){
    $("#photo-form").on('submit', function(e){
        ucitajVarijable();
        e.preventDefault();
        e.stopPropagation();
        var forma = new FormData(this)
        console.log(id)
        forma.append("id",id)
        if(filled == true){
            for (var value of forma.values()) {
                console.log(value); 
             }
            $.ajax({
                type: "POST",
                url: "./backend/azurirajsliku.php",
                data: forma,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response=="sucesfully")
                        window.location="./profil.php"
                    else
                        console.log(response)
                }
            });
        }
    });
}
function ucitajVarijable(){
    slika = $("#file").val();
    opis = $("#opis").val();
    radio = $('input[name=customRadio]:checked', '#photo-form').val()

    provjeraPolja()
}
function provjeraPolja(){
    if(opis == "" || radio == undefined){
        filled=false;
    }
    else{
        filled=true;
    }
}