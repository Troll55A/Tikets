'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: GetActivos,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function GetActivos(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM activos`
    )
}
