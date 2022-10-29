var table = document.getElementById("table_");
var tr = table.getElementsByTagName("tr");
var input = document.getElementById("search_input");
var filterSelect = document.getElementById("search_filter_form");

function search() {
// Declare variables
    var textInput, td, i, txtValue, filterBy;
    textInput = input.value.toUpperCase();
    filterBy = filterSelect.selectedIndex;

    // Loop through all table rows, and hide those who don't match the search query

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[filterBy];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(textInput) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
