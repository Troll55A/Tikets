'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    prGetUsuario: prGetUsuario,
}
console.log("funcion model")
//crear una funcion de get usuarios que ara una peticion a la bd
function prGetUsuario(){
    return helpers.mysqlQuery('GET',conn_mysql,`SELECT * FROM usuarios`)
}
