'use strict'
const helpers = require('../modules/helpers');
module.exports = {
    fnGetArea: fnGetArea,
    fnagregaArea : fnagregaArea,
    existNomArea : existNomArea
}
//
//crear una funcion de get usuarios que ara una peticion a la bd
function fnGetArea(){
    
    return helpers.mysqlQuery('GET',conn_mysql,
    `SELECT * FROM area`
    )
}

function fnagregaArea(datos) {
    return helpers.mysqlQuery('POST', conn_mysql,
    `INSERT INTO area(nombre_area, idlugar) VALUES (@nombre_area,@idlugar)`
    ,datos)
}

function existNomArea(datos) {
    console.log("Existerea",datos)
    return helpers.mysqlQuery('GET', conn_mysql,
    `SELECT * FROM area`
    ,datos)
}