'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetTipoActivos: fnGetTipoActivos,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetTipoActivos(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM tipoactivo`
    )
}
