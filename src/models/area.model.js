'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetArea: fnGetArea,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetArea(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM area`
    )
}
