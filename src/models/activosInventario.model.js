'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetActivos: fnGetActivos,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetActivos(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM activos`
    )
}
