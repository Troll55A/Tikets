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
    console.log("👀",datos)
    return helpers.mysqlQuery('POST', conn_mysql,
    `call setArea(@nombre_area,@idlugar)`
    ,datos)
}

function existNomArea(datos) {
    console.log("Funcion ExistNomArea",datos)
    return helpers.mysqlQuery('GET', conn_mysql,
  //  `SELECT * FROM (SELECT @nombre_area,@idlugar) AS tmp WHERE NOT EXISTS (SELECT nombre_area FROM area WHERE nombre_area=@nombre_area) LIMIT 1;`
  `call setArea(@nombre_area,@idlugar)`
    ,datos)
}