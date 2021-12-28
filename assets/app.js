/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// loads from node_modules
import 'bootstrap'
import $ from 'jquery';
import 'datatables.net-bs5'

// start the Stimulus application
import './bootstrap';

$(function(){
    $('#camperList').DataTable({
        "paging": false,
        "info": false
    });
});