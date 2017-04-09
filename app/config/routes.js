/**
 * Route Mappings
 * (sails.config.routes)
 *
 * Your routes map URLs to views and controllers.
 *
 * If Sails receives a URL that doesn't match any of the routes below,
 * it will check for matching files (images, scripts, stylesheets, etc.)
 * in your assets directory.  e.g. `http://localhost:1337/images/foo.jpg`
 * might match an image file: `/assets/images/foo.jpg`
 *
 * Finally, if those don't match either, the default 404 handler is triggered.
 * See `api/responses/notFound.js` to adjust your app's 404 logic.
 *
 * Note: Sails doesn't ACTUALLY serve stuff from `assets`-- the default Gruntfile in Sails copies
 * flat files from `assets` to `.tmp/public`.  This allows you to do things like compile LESS or
 * CoffeeScript for the front-end.
 *
 * For more information on configuring custom routes, check out:
 * http://sailsjs.org/#!/documentation/concepts/Routes/RouteTargetSyntax.html
 */

module.exports.routes = {

  /***************************************************************************
  *                                                                          *
  * Make the view located at `views/homepage.ejs` (or `views/homepage.jade`, *
  * etc. depending on your default view engine) your home page.              *
  *                                                                          *
  * (Alternatively, remove this and add an `index.html` file in your         *
  * `assets` directory)                                                      *
  *                                                                          *
  ***************************************************************************/

  '/': {
    view: 'home'
  },

  /***************************************************************************
  *                                                                          *
  * Custom routes here...                                                    *
  *                                                                          *
  * If a request to a URL doesn't match any of the custom routes above, it   *
  * is matched against Sails route blueprints. See `config/blueprints.js`    *
  * for configuration options and examples.                                  *
  *                                                                          *
  ***************************************************************************/

  /* ========== Main menu ========== */

  // Apprendre
  'GET /apprendre': { view: 'apprendre' },
  'GET /apprendre/conseils' : { view: 'conseils' },
  'GET /apprendre/tutoriels' : { view: 'tutoriels' },
  'GET /apprendre/tutoriels/1': { view: 'tutoriel-1' },
  'GET /apprendre/tutoriels/2': { view: 'tutoriel-2' },
  'GET /apprendre/tutoriels/3': { view: 'tutoriel-3' },
  'GET /apprendre/ergonomie': { view: 'ergonomie' },

  // Pratiquer
  'GET /pratiquer': { view: 'pratiquer' },
  'GET /pratiquer/bases/facile': { view: 'exercice', locals: { mode: 'Bases' } },
  'GET /pratiquer/digrammes/facile': { view: 'exercice', locals: { mode: 'Digrammmes' } },
  'GET /pratiquer/trigrammes/facile': { view: 'exercice', locals: { mode: 'Trigrammes' } },
  'GET /pratiquer/mots/facile': { view: 'exercice', locals: { mode: 'Mots' } },
  'GET /pratiquer/phrases/facile': { view: 'exercice', locals: { mode: 'Phrases' } },
  'GET /pratiquer/code/facile': { view: 'exercice', locals: { mode: 'Code' } },
  'GET /pratiquer/custom/facile': { view: 'exercicePerso', locals: { mode: 'Custom' } },

  // Affronter
  'GET /affronter': { view: 'affronter' },
  'GET /affronter/solo': { view: 'exercice', locals: { mode: 'Solo'} },
  'GET /affronter/prive': { view: 'competition', locals: { mode: 'Privé' } },
  'GET /affronter/public': { view: 'competition', locals: { mode: 'Public' } },

  /* ========== Footer ========== */

  'GET /mentions-legales': { view: 'mentions-legales' },
  'GET /faq': { view: 'faq' },
  'GET /plan-du-site': { view: 'plan-du-site' },
  'GET /classement/jour': { view: 'classement' },

  /* ========== Misc. ========== */

  'GET /recompenses': { view: 'recompenses' },
  'GET /authentification': { view: 'authentification' },
  'GET /profil': { view: 'profil-statique' }

};
