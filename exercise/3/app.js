// Load in our dependencies
var express = require('express');
var jwt = require('jsonwebtoken');
var mysql = require('mysql');
const bodyParser = require('body-parser');

var api_secret = 'supersecret'

var app = express();

// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }))

// parse requests of content-type - application/json
app.use(bodyParser.json())

// Register the home route that displays a welcome message
// This route can be accessed without a token

app.get('/', function(req, res){
  res.send("Welcome to our API");
})

// Register the route to get a new token
// In a real world scenario we would authenticate user credentials
// before creating a token, but for simplicity accessing this route
// will generate a new token that is valid for 2 minutes

app.get('/token', function(req, res){
  var token = jwt.sign({username:"ado"}, api_secret, {expiresIn: 1200});
  res.send(token)
})

// Register a route that requires a valid token to view data

app.get('/api', function(req, res){
  var token = req.query.token;
  jwt.verify(token, api_secret, function(err, decoded){
    if(!err){
    	console.log("token validated");
    } else {
      res.send(err);
    }
  })
})

// Require site routes
const siteRoutes = require('./src/routes/site.routes')

// using as middleware
app.use('/api/v1/sites', siteRoutes)

// Launch our app on port 3000
app.listen('3000');