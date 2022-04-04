window.onload=function(){
  // Sélection du bouton SWITCH
  var switchButton = document.getElementById("switch");

  // Relier l'event listener au bouton
    if(switchButton) {
      // Event listener
      switchButton.addEventListener("click", onSwitchClick);
    }

for (var j = 0; j < utilisateur.length; j++) {
  utilisateur[j].disabled = true;
}

} // FIN du ONLOAD

// si TRUE => on update le haut de la page, si FALSE => on update le bas de la page
var updateUp = true;     
console.log("updateUp : " + updateUp);    

var entreprise = document.getElementsByClassName("entreprise");
var utilisateur = document.getElementsByClassName("utilisateur");
console.log(entreprise);
console.log(utilisateur);

// Switch des classes pour bloquer/débloquer l'accès au formulaire de modification
var onSwitchClick = function() {
      updateUp = !updateUp;
      console.log("updateUp : " + updateUp);    
      for (var i = 0; i < entreprise.length; i++) {
        entreprise[i].disabled = !entreprise[i].disabled;
      }
      for (var j = 0; j < utilisateur.length; j++) {
        utilisateur[j].disabled = !utilisateur[j].disabled;
      }

      // Si on veut modifier le haut (entreprise)
      if(updateUp) {
      } else 
      // Sinon, on modifie le bas (utilisateur)
      {
       

      }
};
