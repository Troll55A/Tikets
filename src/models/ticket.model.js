'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetTicket: fnGetTicket,
    setTicket:setTicket,
    existNomTicket:existNomTicket
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetTicket(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM tiket`
    )
}
function setTicket(datos) {
    console.log("Funcion existNomLicen",datos)
    return helpers.mysqlQuery('GET', conn_mysql,
    `SELECT * FROM tiket`
    ,datos)
}
function existNomTicket(datos) {
    console.log("Funcion existNomLicen",datos)
    return helpers.mysqlQuery('SET', conn_mysql,
    `INSERT INTO servicios (idfolios,fecha_registro,idtipo_servicio,asunto,mensaje,foto1,foto2,foto3,foto4,solucion,firma,estado_ticket)
    VALUES (@idfolios,@fecha_registro,@idtipo_servicio,@asunto,@mensaje,@foto1,@foto2,@foto3,@foto4,@solucion,@firma,@estado_ticket)`
    ,datos)
}