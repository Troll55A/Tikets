'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetTicket: fnGetTicket,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetTicket(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM tiket`
    )
}
