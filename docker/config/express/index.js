const express = require("express");
const app = express();

app.get("/", (req, res) => {
  res.send("Hello from Docker, Is working ?");
});

app.listen(3000, () => {
  console.log("Server is running on Port 3000.");
});