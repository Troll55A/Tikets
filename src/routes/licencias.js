'use strict'
const express = require('express');
const router = express.Router();
const licenciasCrtl = require ('../controllers/licencias.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',fnGetLicencias);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function fnGetLicencias(req,res){
    licenciasCrtl.fnGetLicencias()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;