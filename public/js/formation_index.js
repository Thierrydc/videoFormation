window.onload = () => {
    const categoryForm = document.querySelector("#category_form");
    const select_category = document.querySelector("#select_category");

    select_category.addEventListener("change", e => {
        let category = e.target.value;
        console.log(category);

        // On récupère l'url active
        const Url = new URL(window.location.href);

        // On lance la requête ajax
        fetch(Url.pathname + "?cat=" + category + "&ajax=1", {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => 
            response.json()
        ).then(data => {
            // On va chercher la zone de contenu
            const content = document.querySelector(".list_formation");

            // On remplace le contenu
            content.innerHTML = data.content;

            // On met à jour l'url
            history.pushState({}, null, Url.pathname + "?cat=" + category);
        }).catch(e => alert(e));
    })
}