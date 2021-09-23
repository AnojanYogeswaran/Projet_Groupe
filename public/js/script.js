const deleteBtn = document.querySelectorAll(".deleteModalBtn");
//Recupere le lien de l'element à supprimer de l'attribut href parent et l'inserer dans le l'attribut href du boutton du modal
const deletRedirect = (e) => {
  {
    e.preventDefault();
    const link = e.target.href;
    document.querySelector("#delete").setAttribute("href", link);
    var row = e.target.parentNode;
  }
};

deleteBtn.forEach((element) => {
  element.addEventListener("click", (e) => deletRedirect(e));
});
