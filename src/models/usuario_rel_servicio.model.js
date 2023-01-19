'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetRelacion: fnGetRelacion,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetRelacion(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM usuarios_rel_servicios`
    )
}
