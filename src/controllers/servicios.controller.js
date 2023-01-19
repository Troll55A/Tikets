'use strict'
const serviciosModels = require ('../models/servicios.model');
module.exports = {
    fnGetServicios: fnGetServicios,
}

function fnGetServicios(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        serviciosModels.fnGetServicios()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar Servicios'}))
        })
    })
}