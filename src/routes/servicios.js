'use strict'
const express = require('express');
const router = express.Router();
const serviciosCrtl = require ('../controllers/servicios.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',GetServicios);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function GetServicios(req,res){
    serviciosCrtl.GetServicios()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;