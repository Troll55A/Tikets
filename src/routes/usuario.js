'use strict'
const express = require('express');
const router = express.Router();
const usuarioCtrl = require ('../controllers/usuario.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',prGetUsuario);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function prGetUsuario(req,res){
    usuarioCtrl.prGetUsuario()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;