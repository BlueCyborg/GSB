<section class="bg-light">
    <div class="container">
        <div class="structure-hero pt-lg-5 pt-4">
            <h1 class="titre text-center">Profil</h1>
            <p class="text text-center">
                Vos informations personnelles.
            </p>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5">
                <img class="img-fluid w-75" src="assets/img/profil.png">
            </div>
            <div class="test col-12 col-sm-8 col-lg-6 col-xl-5 col-xxl-4 py-lg-5 py-3">
                <div class="formulaire">

                    <p><span class="carac">Matricule</span> : <?=htmlspecialchars($info[0])?></p>
                    <p><span class="carac">Nom</span> : <?=htmlspecialchars($info[1])?></p>
                    <p><span class="carac">Prenom</span> : <?=htmlspecialchars($info[2])?></p>
                    <p><span class="carac">Rue</span> : <?=htmlspecialchars($info[3])?></p>
                    <p><span class="carac">Code Postal</span> : <?=htmlspecialchars($info[4])?></p>
                    <p><span class="carac">Ville</span> : <?=htmlspecialchars($info[5])?></p>
                    <p><span class="carac">Date d'embauche</span> : <?=htmlspecialchars($info[6])?></p>
                    <p><span class="carac">Habilitation</span> : <span style="color:#0DCAF0;font-weight: 700;"> <?=htmlspecialchars($info[7])?></span></p>
                    <p><span class="carac">Secteur</span> : <?=htmlspecialchars($info[8])?></p>
                    <p><span class="carac">Région</span> : <?=htmlspecialchars($info[9])?></p>

                </div>
            </div>
        </div>
</section>