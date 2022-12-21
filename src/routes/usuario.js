'use strict'
const express = require('express');
const router = express.Router();
const usuarioCtrl = ('../controllers/usuario.controller.js');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',Get);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
function Get(req,res){
    usuarioCtrl.Get()
    .then(function (result){
        res.json(result);
    })
}
module.exports = router;