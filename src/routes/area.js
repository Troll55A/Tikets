'use strict'
const express = require('express');
const router = express.Router();
const AreaCrtl = require ('../controllers/area.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',fnGetArea);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function fnGetArea(req,res){
    AreaCrtl.fnGetArea()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;