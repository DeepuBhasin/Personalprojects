let serachBox = document.querySelector('#search_box');

serachBox.addEventListener('keyup', (e) => {
    load_data(e.target.value);
})


function get_text(event) {
    let string = event.textContent.split(',');

    let nameString = string[0];
    let getIndex = nameString.indexOf(':') + 2;
    let newString = nameString.substring(getIndex, nameString.length);
    document.querySelector("#search_box").value = newString;
    document.querySelector("#search_result").innerHTML = "";
}

function load_data(query) {
    var form_data = new FormData();

    form_data.append("query", query);

    var ajax_request = new XMLHttpRequest();

    ajax_request.open("POST", "suggestion.php");

    ajax_request.send(form_data);

    ajax_request.onreadystatechange = function () {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            var response = JSON.parse(ajax_request.responseText);

            var html = '<div class="list-group">';

            if (response.length > 0) {
                for (var count = 0; count < response.length; count++) {
                    html +=
                        '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">' +
                        response[count].fullname +
                        "</a>";
                }
            } else {
                html +=
                    '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
            }

            html += "</div>";

            document.getElementById("search_result").innerHTML = html;
        }
    };
}
