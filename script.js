console.log("JavaScript carregado corretamente");
function validarsenha() {
    var senha = document.getElementById("senha").value;
    var senha_c = document.getElementById("senha_c").value;

    if (senha !== senha_c) {
        alert("As senhas não conferem");
        return false;
    }
    return true;
}
