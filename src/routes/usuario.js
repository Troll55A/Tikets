'use strict'
const express = require('express');
const router = express.Router();
const usuarioCtrl = require ('../controllers/usuario.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',Getusuario);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
console.log("Routes")

function Getusuario(req,res){
    usuarioCtrl.Getusuario()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;