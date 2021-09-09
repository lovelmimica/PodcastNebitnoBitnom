addLoadEvent(() => {
    let form = document.querySelector("#sort_form");
    if(form){
        let sortEpisodes = (order) => {
            let episodeListWrapper = document.querySelector(".episode-list");
            episodeListWrapper.style.opacity = '0.5';
            let episodeList = document.querySelector(".episode-list .elementor-posts");
            let switching = true;            

            while(switching){
                switching = false;
                let episodeNodes = episodeList.getElementsByTagName("article");
                
                for(var i = 0; i < (episodeNodes.length - 1); i++){
                    var shouldSwitch = false;

                    //Odrediti da li se tekuci i sljedeci clan trebaju zamijeniti
                    let idCurrent = (episodeNodes[i].id).substring(5);
                    let idNext = (episodeNodes[i + 1].id).substring(5);
                    
                    if(order.indexOf(idCurrent) > order.indexOf(idNext)){
                        shouldSwitch = true;
                        break;
                    }
                }

                if(shouldSwitch){
                    episodeNodes[i].parentNode.insertBefore(episodeNodes[i + 1], episodeNodes[i]);
                    switching = true;
                }
            }
            episodeListWrapper.style.opacity = '1';
        }
        //Get sorted ids
        let url = "https://nebitno-o-bitnom.com/wp-json/post-sort/v1/get-sorted-ids";
        fetch(url)
            .then(response => response.json())
            .then(dataJson => JSON.parse(dataJson))
            .then(dataObj => {
                localStorage.setItem("dateAscOrder", dataObj.date_asc);
                localStorage.setItem("dateDescOrder", dataObj.date_desc);
                localStorage.setItem("popularityOrder", dataObj.popularity);
            });

        form.addEventListener("change", event => {
            let selectMenu = document.querySelector("#form-field-field_36367cf");
            let value = selectMenu.options[selectMenu.selectedIndex].value;
            let order = null;

            if(value == "date-asc") order = localStorage.getItem("dateAscOrder");
            else if(value == "date-desc") order = localStorage.getItem("dateDescOrder");
            else if(value == "popularity") order = localStorage.getItem("popularityOrder");

            if(order != null) {
                order = order.split(",");
                sortEpisodes(order);
            }
        });
    }
});