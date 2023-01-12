'use strict'
const activosModels = require ('../models/activosInventario.model');
module.exports = {
    Get: Get,
}

function Get(){
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        activosModels.Get()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, activos:result.result}: reject({ok:false, error:'Error al consultar activos'}))
        })
    })
}