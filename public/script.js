document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM w pełni załadowany.");

    const forms = document.querySelectorAll('form');
    console.log("Liczba znalezionych formularzy:", forms.length);

    if (forms.length === 0) {
        console.warn("Brak formularzy na stronie.");
        return;
    }

    forms.forEach(form => {
        console.log("Przetwarzanie formularza:", form);

        if (form instanceof HTMLFormElement) {
            console.log("Dodajemy event listener do formularza:", form);

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(form);
                const xhr = new XMLHttpRequest();
                const actionUrl = form.getAttribute('action');
                const method = form.getAttribute('method').toUpperCase();

                console.log("Wysyłamy dane formularza za pomocą metody:", method, "do:", actionUrl);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        const responseDiv = form.querySelector('[id^=response]');
                        if (responseDiv) {
                            if (xhr.status === 200) {
                                responseDiv.innerHTML = xhr.responseText;
                            } else {
                                responseDiv.innerHTML = "Wystąpił błąd. Spróbuj ponownie.";
                            }
                        }
                    }
                    window.location.href = actionUrl;
                };

                xhr.open(method, actionUrl, true);

                if (method === 'POST') {
                    xhr.send(formData);
                } else {
                    const queryString = new URLSearchParams(formData).toString();
                    xhr.open('GET', actionUrl + '?' + queryString, true);
                    xhr.send();
                }
            });
        } else {
            console.warn("Nie można dodać event listenera - formularz nie istnieje.");
        }
    });
});
