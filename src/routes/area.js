'use strict'
const express = require('express');
const router = express.Router();
const AreaCrtl = require ('../controllers/area.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',GetArea);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function GetArea(req,res){
    AreaCrtl.GetArea()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;