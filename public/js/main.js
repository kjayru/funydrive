const btnzip = document.getElementById("zipcode");

let num = 0;
let total = 0;
btnzip.addEventListener('keyup',function(e){
   
   
    if(num<4){
        num +=1;
        console.log(num);
    }else{
        console.log('ejecuta..');
        num = 0;
        total = 0;
       conteo();
    }
    
});

function conteo(){     
        consultacode();
}

let boxmsg = document.querySelector('.box-msn');
function consultacode(){
    let codigo = document.getElementById("zipcode").value;
    
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