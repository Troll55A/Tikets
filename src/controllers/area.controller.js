'use strict'
const AreaModels = require ('../models/area.model');
module.exports = {
    fnGetArea: fnGetArea,
    fnagregaArea : fnagregaArea,
    
}

function fnGetArea(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        AreaModels.fnGetArea()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar area'}))
        })
    })
}
function fnagregaArea(datos) {
    return new Promise(function (resolve, reject) {
        AreaModels.existNomArea(datos)
            .then(function (result) {
                if (!result.err) {
                    if (result.result[0].length > 0) {
                        resolve({ ok: false, mensaje: 'Ya existe un Area con este nombre' });
                    } else {
                        AreaModels.fnagregaArea(datos)
                            .then(function (result) {
                                if (result.err) {
                                    resolve({ ok: false, mensaje: 'No se pudo agregar el Area' });
                                } else {
                                    resolve({ ok: true, addenda: result.result[0] });
                                }
                            });
                    }
                } else {
                    resolve({ ok: true, addenda: result.result[0] });
                }
            });

    });
}