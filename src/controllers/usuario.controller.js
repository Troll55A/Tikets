'use strict'
const usuarioModels = require ('../models/usuario.model');
module.exports = {
    fnGetUsuario: fnGetUsuario,
}

function fnGetUsuario(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        usuarioModels.fnGetUsuario()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar usuario'}))
        })
    })
}