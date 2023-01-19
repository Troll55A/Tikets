'use strict'
const express = require('express');
const router = express.Router();
const activoCtrl = require ('../controllers/activosInventario.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',fnGetActivos);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function fnGetActivos(req,res){
    activoCtrl.fnGetActivos()
    .then(function (result){
        res.json(result);
    })
}
module.exports = router;