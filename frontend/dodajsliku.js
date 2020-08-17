var filled,slika,opis,radio;
$(document).ready(function () 
{
    submitPhoto()
});
function submitPhoto(){
    $("#photo-form").on('submit', function(e){
        ucitajVarijable();
        e.preventDefault();
        e.stopPropagation();
        if(filled == true){
            $.ajax({
                type: "POST",
                url: "./backend/dodajsliku.php",
                data: new FormData(this),
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

    console.log(slika)
    console.log(opis)
    console.log(radio)
    provjeraPolja()
}
function provjeraPolja(){
    if(slika==undefined || slika=="" || opis == "" || radio == undefined){
        filled=false;
    }
    else{
        filled=true;
    }
}