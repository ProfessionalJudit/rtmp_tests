const express = require("express");
const app = express();

app.use(express.urlencoded({ extended: true }));

const mysql = require('mysql2')

//FIX ERROR: CANT ADD COMMAND WHEN CONECTION IS IN CLOSED STATE
app.post("/auth", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })  
  //req.body.key
  console.log("Auth on: " + req.path);
  var found = false
  connection.connect()
  connection.query('SELECT username,token_1,token_2 from Users', (err, rows) => {
    console.log("Log "+JSON.stringify(rows))
    console.log(req.body)
    console.log("Log "+err)
    console.log("Checks: ")
    rows.forEach(row => {
      console.log(req.body.name == row.username)
      console.log(req.body.name + " " + row.username)
      console.log(req.body.key == row.token_1)
      console.log(req.body.key + " " + row.token_1)
      console.log(req.body.pass == row.token_2)
      console.log(req.body.pass + " " + row.token_2)
      if (req.body.name == row.username && req.body.key == row.token_1 && req.body.pass == row.token_2) {        
        console.log("FOUDN!")
        console.log(found)
        found = true
        console.log(found)
      }
    });
    if (err){ 
      res.status(403).send();
    }
    if (found) {
      console.log("Allowed")
      res.status(200).send();

      console.log(found)
    }else{
      console.log("Not Allowed")
      console.log(found)
      res.status(403).send();
    }
    console.log("Conection closed")
  })
  connection.end()  
});

app.post("/getchanel", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })  
  var found = false
  var chanel = req.body.name
  var chanel_description = ""
  console.log(req.body)
  connection.connect()
  connection.query('SELECT username,chanel_description from Users', (err, rows) => {
    rows.forEach(row => {  
      if (chanel == row.username) {        
        found = true;
        chanel_description = row.chanel_description;
      }
    });
    if (found) {
      const response = {
        "Found": "True",
        "Param": chanel,
        "Desc": chanel_description
      };
      res.send(response);
    }else{
      const response = {
        "Found": "False",
        "Param": chanel
      };
      res.send(response);
    }
  });
  connection.end()  
});
//curl -X POST "localhost:3000/getchanel" --data "name=Root"



app.listen(3000, () => {
  console.log("Server is running on Port 3000.");

});


// {
//   app: 'live',
//   flashver: 'FMLE/3.0 (compatible; FMSc/1.0)',
//   swfurl: 'rtmp://localhost/live',
//   tcurl: 'rtmp://localhost/live',
//   pageurl: '',
//   addr: '172.18.0.1',
//   clientid: '3',
//   call: 'publish',
//   name: 'root',
//   type: 'live',
//   key: 'rootkey',
//   pass: 'rootpass'
// }
