'use strict'
const express = require('express');
const router = express.Router();
const activoCtrl = require ('../controllers/activosInventario.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',Get);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
console.log("Routes")

function Get(req,res){
    activoCtrl.Get()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;