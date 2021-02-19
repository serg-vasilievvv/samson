(function () {
    "use strict";

    BX(function () {

        document.querySelector('.addbyxml .btn-more').addEventListener('click', function () {
            var src = document.querySelector('.addbyxml .multiple');
            var bkp = src.cloneNode(true);
            bkp.querySelector('input').value = '';
            bkp.querySelector('label').innerHTML = '';
            src.parentNode.appendChild(bkp);
        });

        document.querySelector('.addbyxml .inputs').addEventListener('focusout', function (ev) {
            var self = ev.target;
            if (event.target.matches('input')) {
                var xmlid = self.value;
                var label = self.parentNode.parentNode.querySelector('label');
                if (xmlid.length) {
                    BX.ajax({
                        url: document.location.href,
                        data: {
                            'action': 'title',
                            'XML_ID[]': xmlid
                        },
                        method: 'POST',
                        dataType: 'json',
                        start: true,
                        onsuccess: function (data) {
                            if (data[xmlid]) {
                                label.innerHTML = data[xmlid]['NAME'];
                            } else {
                                label.innerHTML = 'Товар не найден';
                            }
                        }
                    });
                } else {
                    label.innerHTML = '';
                }
            }
        }, false);


    });
})();