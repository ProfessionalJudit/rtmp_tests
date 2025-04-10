const express = require("express");
const app = express();

app.use(express.urlencoded({ extended: true }));

var http = require('http');
var debug = require('debug')('my-express-app:server');
debug.log = console.debug.bind(console);

const mysql = require('mysql')
const connection = mysql.createConnection({
  host: 'mysql',
  user: 'secureuser',
  password: 'securepass',
  database: 'spasm'
})


app.post("/auth", (req, res) => {
  //req.body.key
  connection.connect()
  connection.query('SELECT username,token_1,token_2 from USERS', (err, rows) => {
    if (err) res.status(403).send();
    debug('FETCH USER: ' +  req.path.split('/')[-1]);
    debug('FETCH USER URL: ' +  rows[0].username);
    debug('FETCH KEY: ' +  rows[0].token_1);
    debug('FETCH KEY URL: ' +  req.body.key);
    debug('FETCH PASS: ' +  rows[0].token_2);
    debug('FETCH PASS URL: ' +  req.body.pass);
    console.log("penis")
    if (req.path.split('/')[-1] == rows[0].username && req.body.key == rows[0].token_1 && req.body.pass == rows[0].token_2) {
      res.status(200).send();
    }
  })
  
  res.status(403).send();
  connection.end()

});

app.listen(3000, () => {
  debug('Application has started');
  console.log("Server is running on Port 3000.");
});