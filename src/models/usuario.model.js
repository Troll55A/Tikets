'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetUsuario: fnGetUsuario,
}
console.log("funcion model")
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetUsuario(){
    return helpers.mysqlQuery('GET',conn_mysql,`SELECT * FROM usuarios`)
}
