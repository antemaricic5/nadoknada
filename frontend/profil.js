function ucitajsliku(){
    window.location = "./dodajsliku.html"
}
function obrisisliku(){
    var id = $("#fish-id").val();
    $.ajax({
        type:'POST',
        url:'./backend/obrisiSliku.php',
        data:{id:id},
        success : function(response){
            console.log(response)
            if(response == 1){
                location.reload();
            }
        }
    })
}
function uredisliku(){
    localStorage.setItem("fishId", $("#fish-id").val())
    window.location="./uredisliku.html"
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