'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetServicios: fnGetServicios,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetServicios(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM servicios`
    )
}
