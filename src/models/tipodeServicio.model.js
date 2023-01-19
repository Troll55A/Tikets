'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetTipodeServicio: fnGetTipodeServicio,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetTipodeServicio(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM tipo_servicio`
    )
}
