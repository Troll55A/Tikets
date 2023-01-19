'use strict'
const activostipoModels = require ('../models/tipoActivos.model');
module.exports = {
    fnGetTipoActivos: fnGetTipoActivos,
}

function fnGetTipoActivos(){
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        activostipoModels.fnGetTipoActivos()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, activos:result.result}: reject({ok:false, error:'Error al consultar Tipo de Activos'}))
        })
    })
}