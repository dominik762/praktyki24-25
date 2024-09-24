document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('ajaxForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const name = document.getElementById('name').value;

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('response').innerHTML = xhr.responseText;
            }
        };

        xhr.open('POST', 'server.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.send('name=' + encodeURIComponent(name));
    });

});
