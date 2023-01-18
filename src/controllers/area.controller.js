'use strict'
const AreaModels = require ('../models/area.model');
module.exports = {
    GetArea: Get,
}

function Get(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        AreaModels.Get()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar area'}))
        })
    })
}