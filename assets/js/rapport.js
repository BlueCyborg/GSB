function sendForm() {
    let send = true;
    if (document.getElementById('saisieDef').checked) {
        let med1 = document.getElementById('idMed1').value;

        if (send && med1 == '') {
            send = confirm('Êtes vous sûr de vouloir enregistré le rapport sans avoir saisie de médicament présenté ?');
        }

        /*
        Ajouter echantittion check echantillion
       */
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