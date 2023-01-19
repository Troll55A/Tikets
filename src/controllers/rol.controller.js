'use strict'
const rolModels = require ('../models/rol.model');
module.exports = {
    fnGetRol: fnGetRol,
}

function fnGetRol(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        rolModels.fnGetRol()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar rol'}))
        })
    })
}