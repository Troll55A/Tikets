Promise = require('bluebird');
var mysql = require('mysql');
conn_mysql = null;

var fs = require('fs');

var mysql_cred = JSON.parse(fs.readFileSync(__dirname + '/cred_mysql', 'utf8'));

  