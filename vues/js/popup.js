
     function afficherConfirmation(param) {
        debugger;
      const confirm = document.querySelector(".popup-conteneur");
      const parag = document.querySelector("p");
        if(param === "aj")
            parag.innerText = "Article ajouté avec succès.";
        else if(param === "md"){
            parag.innerText = "Article modifié avec succès.";
        }
        else if(param === "sp"){
            parag.innerText = "Article supprimé avec succès.";
        }
        else 
            parag.innerText = "Opération échouée.";

      confirm.classList.remove("invisible");
      setTimeout(function(){
        confirm.classList.add("invisible");
      }, 2500);
    }
