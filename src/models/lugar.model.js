'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetLugar: fnGetLugar,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetLugar(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM lugar`
    )
}
