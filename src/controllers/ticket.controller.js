'use strict'
const ticketModels = require ('../models/ticket.model');
module.exports = {
    fnGetTicket: fnGetTicket,
    setTicket:setTicket
}

function fnGetTicket(){
    //
    //Una promesa dice: que debe esperar a terminar la funcion para iniciar el siguiente paso
    return new Promise (function(resolve,reject){
        ticketModels.fnGetTicket()
        .then(function(result){
            console.log("resultado del paso 2", result)
            resolve(!result.err ? {ok:true, usuario:result.result}: reject({ok:false, error:'Error al consultar Ticket'}))
        })
    })
}
function setTicket(datos){
    return new Promise(function (resolve) {
        ticketModels.existNomTicket(datos)
            .then(function (result) {
                console.log("👀",result.result[1])
                if (result.result[1]) {
                    resolve({ ok: false, error: 'Ya Existe' });
                } else {
                    resolve({ ok: true, Error: result.result[0] });
                }
            });
    });
}