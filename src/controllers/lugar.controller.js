'use strict'
const lugarModels = require ('../models/lugar.model');
module.exports = {
    GetLugar: Get,
}

function Get(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        lugarModels.Get()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar usuario'}))
        })
    })
}