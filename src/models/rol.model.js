'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetRol: fnGetRol,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetRol(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM rol`
    )
}
