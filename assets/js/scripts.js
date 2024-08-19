var header = document.querySelector('header');
var footer = document.querySelector('footer');
var showmore = document.querySelector('.showmore');
var content = document.getElementById('content');

document.querySelector('nav').addEventListener('click', function(ev) {
    var menu = document.querySelector('.slide-menu');
    if(menu) {
        menu.parentNode.removeChild(menu);
    } else {
        menu = document.createElement('div');
        menu.className = 'slide-menu';
        menu.appendChild(this.querySelector('ul').cloneNode(true));
        document.body.appendChild(menu);
    }
});

document.addEventListener('scroll', function(ev) {
    if(window.pageYOffset) {
        header.classList.add('dark');
        showmore && showmore.classList.add('hide');
    } else {
        header.classList.remove('dark');
        showmore && showmore.classList.remove('hide');
    }
});

showmore && showmore.addEventListener('click', function(ev) {
    content && content.scrollIntoView({behavior: 'smooth'});
});