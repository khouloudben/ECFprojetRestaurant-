// Sélectionnez l'élément spécifique et le bouton
const elementSpecifique = document.querySelector('.element-specifique');
const bouton = document.querySelector('.bouton');

// Ajouter un écouteur d'événement pour le survol de l'élément spécifique
elementSpecifique.addEventListener('mouseover', () => {
  // Ajouter la classe "visible" au bouton
  bouton.classList.add('visible');
});

// Ajouter un écouteur d'événement pour lorsque le curseur sort de l'élément spécifique
elementSpecifique.addEventListener('mouseout', () => {
  // Supprimer la classe "visible" du bouton
  bouton.classList.remove('visible');
});
<style>
.bouton {
    display= none
  }
  
  .visible {
    display=block
  }
</style>