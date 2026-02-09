$(document).ready(function () {
    

    console.log("miJs.js funciona");


    var alerta = $(".alert");

    if (alerta.length > 0) {

        
        window.setTimeout(function() {
            alerta.fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
      
            });
        }, 2500); // 5 segundos
    }

    let form = $(".form-reset")[0];
    let btnReset = $(".btn-reset");

    btnReset.on("click",function () {  
        form.reset()
    })


});