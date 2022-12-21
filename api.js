const express = require ('express');
const bodyParser = require('body-parser'); //ayuda con post get
const api = express();
const cors = require('cors');

api.use(cors());
api.options('*',cors())
api.use(bodyParser.urlencoded({extended:true}));
api.use(bodyParser.json());
console.log("Rutas")

const usuario = require ('./my-app/src/routes/usuario');
api.use('/usuario',usuario)


module.exports = api;