document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formContato");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("processar.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            alert(res.mensagem);
            if (res.status === "sucesso") {
                form.reset();
                listar();
            }
        });
    });

    listar();
});
