var korisnickoime,zaporka,flag;
function ucitajVarijable(){

    korisnickoime = $("#korisnickoime").val();
    zaporka = $("#zaporka").val();

    provjera();
}
function provjera(){
    flag=true;

    provjeriPraznaPolja();

    if(flag == true)
        provjeriJelPostojiKorisnickoIme();
}
function provjeriPraznaPolja(){
    
    if(korisnickoime == ""){
        alert("Popunite polje korisnickog imena!")
        flag = false; 
    }
    
    if(zaporka == ""){
        alert("Popunite polje zaporke!")
        flag = false; 
    }
   
}
function provjeriJelPostojiKorisnickoIme(){
    $.ajax({
        type:'POST',
        url:'./backend/provjeriKorisnickoIme.php',
        data:{korisnickoime:korisnickoime},
        success : function(response){
            if(response == 1){
                alert("Uneseno korisničko ime ne postoji. Molimo vas obavite registraciju.")
            }
            else{
                logirajSe();
            }
        
        }
    })
}
function logirajSe(){
    if(flag == true){
        var data = $("form").serialize();
        console.log(data)
        $.ajax({
            type:'POST',
            url:'./backend/login.php',
            data:data,
            success : function(response){
                console.log(response)
                if(response != 0){
                    aktivnostOnline()
                    relocatePage();
                }
            }
        })
    }
}
function aktivnostOnline(){
    $.ajax({
        type:'GET',
        url:'./backend/aktivnostOnline.php',
        success : function(response){
           
        }
    })
}
function relocatePage(){
   window.location.href="./pocetna.php"
}