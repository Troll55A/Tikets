'use strict'
const RelacionModels = require ('../models/usuario_rel_servicio.model');
module.exports = {
    fnGetRelacion: fnGetRelacion,
}

function fnGetRelacion(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        RelacionModels.fnGetRelacion()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar relacion de usuario y sevicio'}))
        })
    })
}