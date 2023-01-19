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
api.use('/activos',activo)

const ticket = require ('./src/routes/ticket');
api.use('/ticket',ticket)

const servicios = require ('./src/routes/servicios');
api.use('/servicios',servicios)

const lugar = require ('./src/routes/lugar');
api.use('/lugar',lugar)

const area = require ('./src/routes/area');
api.use('/area',area)

const licencias = require ('./src/routes/licencias');
api.use('/licencias',licencias)

const rol = require ('./src/routes/rol');
api.use('/rol',rol)

const tipoactivo = require ('./src/routes/tipoactivo');
api.use('/tipoactivo',tipoactivo)

const usuario_rel_servicio = require ('./src/routes/usuario_rel_servicio');
api.use('/usuario_rel_servicio',usuario_rel_servicio)

const tipodeServicio = require ('./src/routes/tipodeServicio');
api.use('/tipodeServicio',tipodeServicio)

module.exports = api;