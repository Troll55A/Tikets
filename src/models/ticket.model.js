'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: GetTicket,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function GetTicket(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM tiket`
    )
}
