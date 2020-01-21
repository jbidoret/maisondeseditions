import { tns } from 'tiny-slider/src/tiny-slider';

var gallery = document.querySelector('.images');
if(gallery){
    var slider = tns({
        container: '.images',
        items: 1,
        mouseDrag:true,
        slideBy: 'page',
        // controlsText: ["←","→"],
        controlsContainer: ".tns-controls"
    });

}