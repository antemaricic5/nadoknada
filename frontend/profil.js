
function ucitajsliku(){
    window.location = "./dodajsliku.html"
}
function obrisisliku(id){
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
function uredisliku(id){
    localStorage.setItem("fishId", id)
    console.log(localStorage.getItem("fishId"))
    window.location="./uredisliku.html"
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