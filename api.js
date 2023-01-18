const express = require ('express');
const bodyParser = require('body-parser'); //ayuda con post get
const api = express();
const cors = require('cors');

api.use(cors());
api.options('*',cors())
api.use(bodyParser.urlencoded({extended:true}));
api.use(bodyParser.json());
console.log("api")

const usuario = require ('./src/routes/usuario');
api.use('/usuario',usuario)

const activo = require ('./src/routes/activosInventario');
api.use('/activo',activo)

const ticket = require ('./src/routes/ticket');
api.use('/ticket',ticket)

module.exports = api;