window.showNormal = function () {
    document.getElementById("normal").style.display = "block";
    document.getElementById("shiny").style.display = "none";
};

window.showShiny = function () {
    document.getElementById("normal").style.display = "none";
    document.getElementById("shiny").style.display = "block";
};
