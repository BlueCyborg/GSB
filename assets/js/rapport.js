function sendForm() {
    let send = true;
    if (document.getElementById('saisieDef').checked) {
        let med1 = document.getElementById('idMed1').value;

        if (send && med1 == '') {
            send = confirm('Êtes vous sûr de vouloir enregistré le rapport sans avoir saisie de médicament présenté ?');
        }

        if (send && nbEch <= 0) {
            send = confirm('Êtes vous sûr de vouloir enregistré le rapport sans avoir saisie d\'échantillon ?');
        }
    }
    return send;
}

function updateMed(ob) {
    let mot = document.getElementById('med2');
    if (ob.value == '') {
        mot.setAttribute('hidden', '');
        document.getElementById('med2None').selected = true;
    } else {
        mot.removeAttribute('hidden');
    }
}

function updateMotif(ob) {
    let mot = document.getElementById('motifAutreGroup');
    if (ob.value !== 'OTH') {
        mot.setAttribute('hidden', '');
    } else {
        mot.removeAttribute('hidden');
    }
}

//echantillion
function extractExmlpEch() {
    let examp = document.getElementById("examplLine");
    let exampClone = examp.cloneNode(true);
    examp.remove();
    return exampClone;
}

var idEch = 0;
var nbEch = 0;
var examplEch = extractExmlpEch();
var bodyEch = document.getElementById("bodyEch");

function addEch(qte = 1, med = '') {
    let id = 'ech'+idEch;

    //element de base
    let eleBase = examplEch.cloneNode(true);
    eleBase.id = id;
    bodyEch.appendChild(eleBase);

    //qantitee
    let eleQte = document.getElementById("examplQte");
    eleQte.setAttribute("name", "echs["+id+"][qte]");
    eleQte.setAttribute("value", qte);
    eleQte.removeAttribute("id");
    
    //medicament
    let eleMed = document.getElementById("examplMed");
    eleMed.setAttribute("name", "echs["+id+"][med]");
    for (sel of eleMed.children) {
        if (sel.value == med) {
            sel.selected = true;
            break;
        }
    }
    eleMed.removeAttribute("id");

    //remove
    let eleRm = document.getElementById("examplRm");
    eleRm.setAttribute('onclick', 'removeEch("'+id+'")');
    eleRm.removeAttribute("id");

    //increment id
    nbEch++;
    idEch++;
}

function removeEch(id) {
    let ech = document.getElementById(id);
    if (ech != null) {
        ech.remove();
        nbEch--;
    }
}