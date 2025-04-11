const express = require("express");
const app = express();

app.use(express.urlencoded({ extended: true }));

const mysql = require('mysql2')
const connection = mysql.createConnection({
  host: 'mysql',
  user: 'secureuser',
  password: 'securepass',
  database: 'spasm',
  port: 3306
})


app.post("/auth", (req, res) => {
  //req.body.key
  console.log("Auth on: " + req.path);
  connection.connect()
  connection.query('SELECT username,token_1,token_2 from Users', (err, rows) => {
    console.log("Log "+rows)
    console.log("Log "+err)
    if (err){ 
      res.status(403).send();
      connection.end()
    }
    // console.log('FETCH USER: ' +  req.path.split('/')[-1]);
    // console.log('FETCH USER URL: ' +  rows[0].username);
    // console.log('FETCH KEY: ' +  rows[0].token_1);
    // console.log('FETCH KEY URL: ' +  req.body.key);
    // console.log('FETCH PASS: ' +  rows[0].token_2);
    // console.log('FETCH PASS URL: ' +  req.body.pass);
    // if (req.path.split('/')[-1] == rows[0].username && req.body.key == rows[0].token_1 && req.body.pass == rows[0].token_2) {
    //   res.status(200).send();
    // }
  })
  
  res.status(200).send();
  connection.end()

});

app.listen(3000, () => {
  console.log("Server is running on Port 3000.");

});