'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: GetActivos,
}
console.log("funcion model")
//crear una funcion de get usuarios que ara una peticion a la bd
function GetActivos(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM activos`
    )
}
