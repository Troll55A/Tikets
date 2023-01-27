'use strict'
const AreaModels = require ('../models/area.model');
module.exports = {
    fnGetArea: fnGetArea,
    fnagregaArea : fnagregaArea,
    
}

function fnGetArea(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise(function (resolve, reject) {
        AreaModels.fnGetArea()
            .then(function (result) {
                if (result.err) {
                    resolve({ ok: false, error: 'No se pudo obtener las areas' });
                } else {
                    resolve({ ok: true, area: result.result });
                }
            });
    });
}
function fnagregaArea(datos){
    return new Promise(function (resolve) {
        AreaModels.existNomArea(datos)
            .then(function (result) {
                console.log("👀",result.result[1])
                if (result.result[1]) {
                    resolve({ ok: false, error: 'No se inserto' });
                } else {
                    resolve({ ok: true, Error: result.result[0] });
                }
            });
    });
}