'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: GetServicios,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function GetServicios(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM servicios`
    )
}
