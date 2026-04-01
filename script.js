document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("formContato");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // 🔥 impede ir pro PHP

        const formData = new FormData(form);

        fetch("processar.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(res => {

            if (res === "sucesso") {
                alert("Mensagem enviada com sucesso!");
                form.reset();
            } else {
                alert(res);
            }

        })
        .catch(() => {
            alert("Erro ao enviar.");
        });
    });

});