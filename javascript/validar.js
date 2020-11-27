//Função da mascara para substituir valores
function mask(element, maskName) {
    setTimeout(function () {
        var valor = maskName(element.value);
        if (valor != element.value) {
            element.value = valor;
        }
    }, 1);
}

//Função para aplicar a mascara em cima de um elemento na pagina (id)
function mascarar(element, maskName) {
    if (document.getElementById(element)) {
        document.getElementById(element).oninput = function () {
            mask(this, maskName);
        }
    }
}

function mTel(v) {
    var r = v.replace(/\D/g,"");
    r = r.replace(/^0/,"");
    if (r.length > 10) {
        // 11+ digitos. Formata como 5+4.
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/,"($1)$2-$3");
    }
    else if (r.length > 5) {
        // 6..10 digitos. Formata como 4+4
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/,"($1)$2-$3");
    }
    return r;
}

function mCpf(v) {
    var r = v.replace(/\D/g,"");
    r = r.replace(/^0/,"");
    r = r.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/,"$1.$2.$3-$4");
    return r;
}

function mCep(v) {
    var r = v.replace(/\D/g,"");
    r = r.replace(/^(\d{8}).*/,"$1");
    return r;
}

function mUf(v) {
    var r = v.replace(/[^a-zA-Z]/g,"");
    r = r.replace(/^(\D{2}).*/,"$1");
    r = r.toUpperCase()
    return r;
}

//Realiza funções assim que a tela inicia
window.onload = function () {

    mascarar('cpf', mCpf);
    mascarar('cpftxt', mCpf);
    mascarar('telefone', mTel);
    mascarar('cep', mCep);
    mascarar('uf', mUf);

}