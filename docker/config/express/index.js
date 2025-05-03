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
    console.log("Log " + JSON.stringify(rows))
    console.log(req.body)
    console.log("Log " + err)
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
    if (err) {
      res.status(403).send();
    }
    if (found) {
      console.log("Allowed")
      res.status(200).send();

      console.log(found)
    } else {
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
  var img1 = ""
  var img2 = ""
  console.log(req.body)
  connection.connect()
  connection.query('SELECT username,chanel_description,imgname ,smallimgname from Users, Extra WHERE Users.uid = Extra.chanelid', (err, rows) => {
    rows.forEach(row => {
      console.log("JUDITOSEARCH. " +chanel + " : "+ row.username)
      if (chanel == row.username) {
        found = true;
        chanel_description = row.chanel_description;
        img1 = row.imgname;
        img2 = row.smallimgname;
        
      }
    });
    if (found) {
      const response = {
        "Found": "True",
        "Param": chanel,
        "Desc": chanel_description,
        "img1": img1,
        "img2": img2
      };
      res.send(response);
    } else {
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

app.post("/getfull", (req, res) => {
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
  var img1 = ""
  var img2 = ""
  var token1 = ""
  var token2 = ""
  var email = ""

  console.log(req.body)
  connection.connect()
  connection.query('SELECT username,chanel_description,token_1,token_2,email,imgname,smallimgname from Users, Extra WHERE Users.uid = Extra.chanelid', (err, rows) => {
    rows.forEach(row => {
      if (chanel == row.username) {
        found = true;
        chanel_description = row.chanel_description;
        img1 = row.imgname;
        token1 = row.token_1;
        token2 = row.token_2;
        email = row.email;

      }
    });
    if (found) {
      const response = {
        "Found": "True",
        "chanel": chanel,
        "Desc": chanel_description,
        "img1": img1,
        "img2": img2,
        "token1": token1,
        "token2": token2,
        "email": email

      };
      res.send(response);
    } else {
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


app.post("/search", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })
  var found = []
  var params = req.body.params
  if (params == null) {
    params = "";
  }
  console.log(req.body)
  console.log("WAH! " + 'SELECT username FROM Users where LOCATE("' + params + '",username) > 0');
  connection.connect()
  connection.query('SELECT username FROM Users where LOCATE("' + params + '",username) > 0', (err, rows) => {
    if (rows) {
      rows.forEach(row => {
        found.push(row.username);
      });
    }
    const response = {
      "Found": found,
      "Param": params
    };
    res.send(response);
  });
  connection.end()
});


app.listen(3000, () => {
  console.log("Server is running on Port 3000.");

});

app.post("/canlogin", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })
  var allowed = false
  var user = req.body.user
  var pass = req.body.pass
  console.log(req.body.user)
  console.log(req.body.pass)

  connection.connect()
  connection.query('SELECT username,password from Users', (err, rows) => {
    rows.forEach(row => {
      console.log(row.username)
      console.log(row.password)
      if (user == row.username && pass == row.password) {
        allowed = true;
      }
    });
    if (allowed) {
      const response = {
        "allowed": "true"
      };
      res.send(response);
    } else {
      const response = {
        "allowed": "false"
      };
      res.send(response);
    }
  });
  connection.end()
});
app.post("/change", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })
  console.log(req.body);

  var user = req.body.user
  var desc = req.body.desc
  var img1 = req.body.img1
  var img2 = req.body.img2
  console.log('UPDATE Users SET chanel_description = "' + desc + '" WHERE username LIKE "' + user + '"')
  connection.query('UPDATE Users SET chanel_description = "' + desc + '" WHERE username LIKE "' + user + '"', (err, res) => {
    console.log(res.affectedRows + " record(s) updated");

  });
  connection.connect()
  if (req.body.img1 != 'NOCHANGE') {
    connection.query('UPDATE Extra, Users SET imgname = "' + img1 + '" WHERE Users.uid = Extra.chanelid and username LIKE "' + user + '"', (err, res) => {
      console.log(res.affectedRows + " record(s) updated");

    });
  }

  if (req.body.img2 != 'NOCHANGE') {
    connection.query('UPDATE Extra, Users SET smallimgname = "' + img2 + '" WHERE Users.uid = Extra.chanelid and username LIKE "' + user + '"', (err, res) => {
      console.log(res.affectedRows + " record(s) updated");

    });
  }
  connection.end()
  res.status(200).send();
});

app.post("/createaccount", (req, res) => {
  const connection = mysql.createConnection({
    host: 'mysql',
    user: 'secureuser',
    password: 'securepass',
    database: 'spasm',
    port: 3306
  })
  console.log("убите мне");
  console.log(req.body);

  var user = req.body.user
  var desc = req.body.desc
  var pass = req.body.pass
  var mail = req.body.mail
  var img1 = req.body.img1
  var img2 = req.body.img2
  var token1 = ""
  var token2 = ""
  const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for (let i = 0; i < 16; i++) {
    token1 += chars.charAt(Math.floor(Math.random() * chars.length));
    token2 += chars.charAt(Math.floor(Math.random() * chars.length));

  }

  const response = {
    "wdwwddw": "faldwdwse",
    "user": user,
    "desc": desc,
    "pass": pass,
    "mail": mail,
    "img1": img1,
    "img2": img2

  };
  connection.connect()
  // console.log("INSERT INTO Users (username,password,email,chanel_description,token_1,token_2)" +
  //    "VALUES ('" + user + "','" + pass + "','" + mail + "','" + desc + "','" + token1 + "','" + token2 + "')")
  
  connection.query("INSERT INTO Users (username,password,email,chanel_description,token_1,token_2)" +
     "VALUES ('" + user + "','" + pass + "','" + mail + "','" + desc + "','" + token1 + "','" + token2 + "')", (err, res) => {
  });
  connection.query('INSERT INTO Extra (chanelid,imgname,smallimgname) VALUES ((SELECT COUNT(*) FROM Users),"' + 
    img1 + '","' + img2 + '")', (err, res) => {
    console.log(err)
  });
  connection.end()
  res.send(response);

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
