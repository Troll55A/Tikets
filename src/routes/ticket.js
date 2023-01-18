'use strict'
const express = require('express');
const router = express.Router();
const ticketCrtl = require ('../controllers/ticket.controller');
/***************************RUTAS BASE GET,GETBYID,UPDATE,SET********************************** */
router.get('/get',GetTicket);
/********************************************************************************************* */

/*******************************Funciones BASE GET GETBYID, UPDATE ,SET*********************** */
//

function GetTicket(req,res){
    ticketCrtl.GetTicket()
    .then(function (result){
        res.json(result);
    })
}


module.exports = router;