/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import $ from 'jquery'
import './lib/easing/easing.min.js'
import WOW from './lib/wow/wow.min.js'
window.WOW = WOW;
import './lib/owlcarousel/owl.carousel.min.js'

import jQueryBridget from 'jquery-bridget';
import Isotope from './lib/isotope/isotope.pkgd.min.js';

// make Isotope a jQuery plugin
jQueryBridget( 'isotope', Isotope, $ );
// now you can use $().isotope()
$('.grid').isotope({
  // options...
});
import './lib/lightbox/js/lightbox.min.js'
import './lib/waypoints/waypoints.min.js'
import './lib/counterup/counterup.min.js'
import './lib/slick/slick.min.js'

require ('./js/main.js')