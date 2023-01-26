'use strict'
const activosModels = require ('../models/activosInventario.model');
module.exports = {
    fnGetActivos: fnGetActivos,
    agregaActivos : agregaActivos
}

function fnGetActivos(){
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        activosModels.fnGetActivos()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, activos:result.result}: reject({ok:false, error:'Error al consultar activos'}))
        })
    })
}
function agregaActivos(datos) {
    return new Promise(function (resolve) {
        activosModels.agregaActivos(datos)
                            .then(function (result) {
                                if (result.err) {
                                    resolve({ ok: false, mensaje: 'No se pudo agregar el Activo' });
                                } else {
                                    console.log("Se agregro correctamente:", datos)
                                    resolve({ ok: true, activos: result.result});
                                }
                            });
                    })
                }