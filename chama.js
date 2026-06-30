function pesquisar()
{
    var texto = document.getElementById("pesquisa").value;

    usaAjax("resultado.php?filtro="+texto,"resultado");
}