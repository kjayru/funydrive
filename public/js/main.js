const btnzip = document.getElementById("zipcode");

let num = 0;
let total = 0;
btnzip.addEventListener('keyup',function(e){
    console.log(e.keyCode);
    num +=1;
    conteo(num);
    
});

function conteo(num){
  total = num;
    if(total===5){
        consultacode();
    }
}

let boxmsg = document.querySelector('.box-msn');
function consultacode(){
    let codigo = document.getElementById("zipcode").value;
    let num = 0;
    let total = 0;
    conteo(num);
    let url = `/getpostal/${codigo}`;

    fetch(url).then(function(response){
           // return response;
            return response.json();
            
        })
        .then(function(data){
            boxmsg.style.display = "block";
           if(data.rpta==='ok'){
                boxmsg.innerHTML= `Great! We have certified mobile mechanics in ${data.poblacion}, ${data.provincia}`;
                document.querySelector(".btn-confirmar").style.display='block';
           }else{
                boxmsg.innerHTML= `${data.mensaje}`;   
           }
        })
        .catch(function(error){
            console.log(`error ${error}`);
            
        });
}