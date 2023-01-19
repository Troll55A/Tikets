'use strict'
const express = require('express');
const router = express.Router();
const ticketCrtl = require ('../controllers/ticket.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',fnGetTicket);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function fnGetTicket(req,res){
    ticketCrtl.fnGetTicket()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;