<template>
  <footer class="footer mt-50">
    <div class="container">
      <div class="row">
        <div class="footer-col-1 col-md-3 col-sm-12">
          <a href="index.html"
            ><img
              alt="PortailTN"
              src="/assets/home/imgs/template/jobhub-logo.png"
              class="logo-img"
          /></a>
          <div class="mt-20 mb-20 font-xs color-text-paragraph-2">
            PortailTN est le cœur de la communauté de design et la meilleure
            ressource pour découvrir et se connecter avec des designers et des
            emplois du monde entier.
          </div>
          <div class="footer-social">
            <a class="icon-socials icon-facebook" href="#"></a
            ><a class="icon-socials icon-twitter" href="#"></a
            ><a class="icon-socials icon-linkedin" href="#"></a>
          </div>
        </div>
        <div class="footer-col-2 col-md-2 col-xs-6">
          <h6 class="mb-20">Ressources</h6>
          <ul class="menu-footer">
            <li><a href="#">À propos de nous</a></li>
            <li><a href="#">Notre équipe</a></li>
            <li><a href="#">Produits</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-col-3 col-md-2 col-xs-6">
          <h6 class="mb-20">Communauté</h6>
          <ul class="menu-footer">
            <li><a href="#">Fonctionnalités</a></li>
            <li><a href="#">Tarification</a></li>
            <li><a href="#">Crédit</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>
        <div class="footer-col-4 col-md-2 col-xs-6">
          <h6 class="mb-20">Liens rapides</h6>
          <ul class="menu-footer">
            <li><a href="#">iOS</a></li>
            <li><a href="#">Android</a></li>
            <li><a href="#">Microsoft</a></li>
            <li><a href="#">Desktop</a></li>
          </ul>
        </div>
        <div class="footer-col-5 col-md-2 col-xs-6">
          <h6 class="mb-20">Plus</h6>
          <ul class="menu-footer">
            <li><a href="#">Confidentialité</a></li>
            <li><a href="#">Aide</a></li>
            <li><a href="#">Conditions</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>
        <div class="footer-col-6 col-md-3 col-sm-12">
          <h6 class="mb-20">Télécharger l'application</h6>
          <p class="color-text-paragraph-2 font-xs">
            Téléchargez nos applications et obtenez une remise supplémentaire de
            15% sur votre première commande&mldr;!
          </p>
          <div class="mt-15">
            <a class="mr-5" href="#"
              ><img
                src="/assets/home/imgs/template/icons/app-store.png"
                alt="joxBox" /></a
            ><a href="#"
              ><img
                src="/assets/home/imgs/template/icons/android.png"
                alt="joxBox"
            /></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom mt-50">
        <div class="row">
          <div class="col-md-6">
            <span class="font-xs color-text-paragraph"
              >Copyright &copy; 2022. PortailTN. Tous droits réservés</span
            >
          </div>
          <div class="col-md-6 text-md-end text-start">
            <div class="footer-social">
              <a class="font-xs color-text-paragraph" href="#"
                >Politique de confidentialité</a
              ><a class="font-xs color-text-paragraph mr-30 ml-30" href="#"
                >Conditions générales</a
              ><a class="font-xs color-text-paragraph" href="#">Sécurité</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>


<style scoped>

.logo-img {
  width: 250px; /* Adjust as needed */
}

/* Mobile styles */
@media (max-width: 768px) {
  .logo-img {
    width: 150px; /* Adjust as needed */
  }
}

/* Mobile styles */
@media (max-width: 576px) {
  .logo-img {
    width: 200px; /* Adjust as needed */
  }
}
</style>