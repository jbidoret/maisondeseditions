var Isotope = require('isotope-layout');
import matchesSelector from 'desandro-matches-selector';
var imagesLoaded = require('imagesloaded');


// Store # parameter and add "." before hash
if (window.location.hash) {
    var hashID = "." + window.location.hash.substring(1);
}
var grid = document.querySelector('.grid');

if (grid) {
    var iso = null;
    var filtersElem = document.querySelector('.filters-button-group');
    var buttonGroup = document.querySelector('.button-group');

    imagesLoaded(grid, function () {

        iso = new Isotope(grid, {
            // options
            itemSelector: '.grid-item',
            transitionDuration: 0,
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer',
                gutter: '.gutter-sizer'
            }
        });
        if (hashID) {
            iso.arrange({ filter: hashID });
            buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
            buttonGroup.querySelector('[data-filter="' + hashID +'"]').classList.add('is-checked');
        }
    });



    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function (itemElem) {
            var number = itemElem.querySelector('.number').textContent;
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function (itemElem) {
            var name = itemElem.querySelector('.name').textContent;
            return name.match(/ium$/);
        }
    };

    // bind filter button click

    filtersElem.addEventListener('click', function (event) {
        // only work with buttons
        if (!matchesSelector(event.target, 'a')) {
            return;
        }
        var filterValue = event.target.getAttribute('data-filter');
        // use matching filter function
        filterValue = filterFns[filterValue] || filterValue;
        iso.arrange({ filter: filterValue });
    });

    // change is-checked class on buttons

    buttonGroup.addEventListener('click', function (event) {
        // only work with buttons
        if (!matchesSelector(event.target, 'a')) {
            return;
        }
        buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
        event.target.classList.add('is-checked');
    });


}