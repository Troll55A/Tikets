'use strict'
const express = require('express');
const router = express.Router();
const lugarCrtl = require ('../controllers/lugar.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',GetLugar);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function GetLugar(req,res){
    lugarCrtl.GetLugar()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;