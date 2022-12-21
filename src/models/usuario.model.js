'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    getUsuarios: getUsuarios
}

//crear una funcion de get usuarios que ara una peticion a la bd
function getUsuarios(){
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM usuarios`
    )
}
