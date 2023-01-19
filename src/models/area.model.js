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
    return helpers.mysqlQuery('GET', conn_mysql,
        `call setArea(@nombre_area)`
    ,datos)
}

function existNomArea(datos) {
    console.log("existNomArea",datos)
    return helpers.mysqlQuery('GET', conn_mysql,
    `call getExistNomArea(@nombre_area)`
    ,datos)
}