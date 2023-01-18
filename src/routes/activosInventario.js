'use strict'
const express = require('express');
const router = express.Router();
const activoCtrl = require ('../controllers/activosInventario.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',GetActivos);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
console.log("Routes")

function GetActivos(req,res){
    activoCtrl.GetActivos()
    .then(function (result){
        res.json(result);
    })
}
module.exports = router;