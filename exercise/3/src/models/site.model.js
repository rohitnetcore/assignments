'user strict';
var dbConn = require('./../../config/db.config');

//Site object create
var Site = function(site){
    this.sapid          = site.sapid;
    this.hostname       = site.hostname;
    this.loopback       = site.loopback;
    this.macaddress     = site.macaddress;
};

Site.create = function (newEmp, result) {    
    dbConn.query("INSERT INTO sites set ?", newEmp, function (err, res) {
        if(err) {
            console.log("error: ", err);
            result(err, null);
        }
        else{
            console.log(res.insertId);
            result(null, res.insertId);
        }
    });           
};

Site.findById = function (id, result) {
    dbConn.query("Select * from sites where sapid = ? ", id, function (err, res) {             
        if(err) {
            console.log("error: ", err);
            result(err, null);
        }
        else{
            result(null, res);
        }
    });   
};

Site.findAll = function (result) {
    dbConn.query("Select * from sites", function (err, res) {
        if(err) {
            console.log("error: ", err);
            result(null, err);
        }
        else{
            console.log('sites : ', res);  
            result(null, res);
        }
    });   
};

Site.update = function(id, site, result){
  dbConn.query("UPDATE sites SET hostname=?,loopback=?,macaddress=? WHERE sapid = ?", [site.hostname,site.loopback,site.macaddress,id], function (err, res) {
        if(err) {
            console.log("error: ", err);
            result(null, err);
        }else{   
            result(null, res);
        }
    }); 
};

Site.delete = function(id, result){
     dbConn.query("DELETE FROM sites WHERE sapid = ?", [id], function (err, res) {
        if(err) {
            console.log("error: ", err);
            result(null, err);
        }
        else{
            result(null, res);
        }
    }); 
};

module.exports= Site;