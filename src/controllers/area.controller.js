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
            resolve(!result.err ? {ok:true, area:result.result}: reject({ok:false, error:'Error al consultar area'}))
        })
    })
}
function fnagregaArea(datos) {
    return new Promise(function (resolve, reject) {
        AreaModels.existNomArea(datos)
            .then(function (result) {
                if (!result.err) {
                    if (result.result[0].length > 0) {
                        console.log("Post", result)
                        resolve({ ok: false, mensaje: 'Ya existe el area con este nombre' });
                    } else {
                        AreaModels.fnagregaArea(datos)
                            .then(function (result) {
                                if (result.err) {
                                    resolve({ ok: false, mensaje: 'No se pudo agregar el area' });
                                } else {
                                    resolve({ ok: true, area: result.result[0] });
                                }
                            });
                    }
                } else {
                    resolve({ ok: true, area: result.result[0] });
                }
            });

    });
}