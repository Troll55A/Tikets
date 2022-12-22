'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    Get: Get,
}
console.log("funcion model")
//crear una funcion de get usuarios que ara una peticion a la bd
function Get(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM usuarios`
    )
}
