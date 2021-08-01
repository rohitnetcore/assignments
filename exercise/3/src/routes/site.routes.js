const express = require('express')
const router = express.Router()
const siteController = require('../controllers/site.controller');

// Retrieve all sites
router.get('/', siteController.findAll);

// Create a new site
router.post('/', siteController.create);

// Retrieve a single site with id
router.get('/:id', siteController.findById);

// Update a site with id
router.put('/:id', siteController.update);

// Delete a site with id
router.delete('/:id', siteController.delete);

module.exports = router