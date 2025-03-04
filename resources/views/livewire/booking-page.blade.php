<div>
    <div style="max-width: 1200px; margin: 20px auto">
        <div id="booking">
            <script src="https://atom-s.com/script.js"></script>
            <script type="text/javascript">
                getAtomSBookingScript(function () {
                    function getParameterUrlParam(name) {
                        name = name.replace(/[\[\]]/g, '\\$&');
                        let url = window.location.href,
                            regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                            results = regex.exec(url);
                        if (!results) return null;
                        if (!results[2]) return '';
                        return decodeURIComponent(results[2].replace(/\+/g, ' '));
                    }

                    var atomBooking = new window.atomSBooking();
                    atomBooking.initialize('booking', {
                        "host": 'atom-s.com',
                        "locale": 'ru',
                        "apiVersion": "v2",
                        "apiKey": getParameterUrlParam('showcase'), // Ключь витрины
                        "tourSlug": getParameterUrlParam('tour'), // ID или slug тура
                    }, null, null);
                    atomBooking.display();
                });
            </script>
        </div>
    </div>
</div>
