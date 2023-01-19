'use strict'
const licenciasModels = require ('../models/licencias.model');
module.exports = {
    fnGetLicencias: fnGetLicencias,
}

function fnGetLicencias(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        licenciasModels.fnGetLicencias()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar licencias'}))
        })
    })
}