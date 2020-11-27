function mask(o, f) {
    setTimeout(function () {
        var v = f(o.value);
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
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

function mascarar(element, maskName) {
    if (document.getElementById(element)) {
        document.getElementById(element).oninput = function () {
            mask(this, maskName);
        }
    }
}

window.onload = function () {

    mascarar('cpf', mCpf);
    mascarar('telefone', mTel);
    mascarar('cep', mCep);
    mascarar('uf', mUf);

   /* var o = document.getElementById("cpf");

    id('cpf').oninput = function () {
        mask(this, mCpf);
    }

    if (document.getElementById("cep")) {
        id('cep').oninput = function () {
            mask(this, mCep)
        }
        id('telefone').oninput = function () {
            mask(this, mTel);
        }
        id('uf').oninput = function () {
            mask(this, mUf);
        }
    }*/
}