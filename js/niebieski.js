
var moverclass = {
    __init: function () {
        
        var elem = document.querySelector('.wrapperniebieski'),
                div = document.querySelector('.moveniebieski'),
                x = 0,
                y = 0,
                mousedown = false;

        div.addEventListener('mousedown', function (pozycja) {
            mousedown = true;
            x = div.offsetLeft - pozycja.clientX;
            y = div.offsetTop - pozycja.clientY;
        }, true);

        div.addEventListener('mouseup', function (pozycja) {
            mousedown = false;
        }, true);

        elem.addEventListener('mousemove', function (pozycja) {
            pozycja.preventDefault();
            if (mousedown) {
                div.style.left = pozycja.clientX + x + 'px';
                div.style.top = pozycja.clientY + y + 'px';
				setCookie("niebieskiX",pozycja.clientX + x+'px',1)
            }
        }, true);

    }
};
moverclass.__init();
