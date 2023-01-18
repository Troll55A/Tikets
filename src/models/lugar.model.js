'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: GetLugar,
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function GetLugar(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM lugar`
    )
}
