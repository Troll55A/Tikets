'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetLicencias: fnGetLicencias,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetLicencias(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM licencias`
    )
}
