(function () {
    "use strict";
    document.addEventListener('keydown', function (event) {
        if (!event.ctrlKey || 13 != event.keyCode) return;

        var selection = window.getSelection().getRangeAt(0);

        var hiddenel = document.createElement("div");
        hiddenel.appendChild(selection.cloneContents());

        var message = '<a href="' + document.location.href + '">Ошибка на странице</a><br />' + hiddenel.innerHTML;

        var form = document.getElementById('errcap');
        var action = form.action;

        var inputs = form.querySelectorAll('input[type="hidden"]');
        var fields = {'MESSAGE': message, 'submit': 'Y'};
        for (var i = 0; i < inputs.length; i++) {
            fields[inputs[i].name] = inputs[i].value;
        }

        BX.ajax({
            url: action,
            data: fields,
            method: 'POST',
            dataType: 'json',
            processData: false,
            start: true,
            onsuccess: function (data) {
                console.log(data);
                console.debug('Error report sent')
            },
            onfailure: function () {
                console.debug('Error report failed')
            }
        });
    });
})();

