'use strict'
const express = require('express');
const router = express.Router();
const serviciosCrtl = require ('../controllers/servicios.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',fnGetServicios);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function fnGetServicios(req,res){
    serviciosCrtl.fnGetServicios()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;