
const tables = document.currentScript.getAttribute('tables').split(',');
const defaultMax = 5; // default max items per page;
const cadreDefault = 10;
var navDiv;

function advanced_table(tableId, maxItems) {
    this.maxItems = maxItems - 1;
    this.tableElement = document.querySelector("#"+tableId+" table");
    this.trList = this.tableElement.querySelectorAll("tbody tr");
    this.input = document.querySelector("#"+tableId+" #search_input");
    this.filterSelect = document.querySelector("#"+tableId+" #search_filter_form");

    var page = 0, found_elements, maxPages;
    
    this.search = () => {
        var textInput, td, i, txtValue, filterBy;
        textInput = this.input.value.toUpperCase();
        filterBy = this.filterSelect.selectedIndex;

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < this.trList.length; i++) {
            td = this.trList[i].getElementsByTagName("td")[filterBy];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(textInput) > -1) {
                    this.trList[i].classList.add("found-row");
                } else {
                    this.trList[i].classList.remove("found-row");
                }
            }
        }

        this.init_pagination();
    };

    this.pagination = (p) => {
        page = p;

        for (i = 0, c = 0; i < this.trList.length; i++) {
            if (this.trList[i].classList.contains("found-row")) {
                if (c >= (this.maxItems*page + page) && c <= (this.maxItems*(page+1)) + page) {
                    this.trList[i].style.display = ""
                } else {
                    this.trList[i].style.display = "none"
                }
                c++;
            } else {
                this.trList[i].style.display = "none"
            }
        }

        this.adjustButtons();
    }

    this.adjustButtons = () => {
        if (page == 0) {
            this.btnPrev.style.display = "none";
        } else if (page == 1) {
            this.btnPrev.style.display = "";
        }

        if (page == Math.floor(maxPages)) {
            this.btnNext.style.display = "none";
        } else {
            this.btnNext.style.display = "";
        }
    }
    
    this.tableElement.insertAdjacentElement ("afterend", createNavDiv());
    
    this.btnPrev = document.querySelector("#"+tableId+" .previous");
    this.btnNext = document.querySelector("#"+tableId+" .next");

    this.btnPrev.addEventListener("click", () => {
        if (page > 0) {
            this.pagination(page-1);
        }
    });

    this.btnNext.addEventListener("click", () => {
        if (page < maxPages) {
            this.pagination(page+1);
        }
    });


    this.init_pagination = ()  => {
        found_elements = document.querySelectorAll("#"+tableId+" .found-row").length
        maxPages = found_elements / (this.maxItems +1);
        this.pagination(0);
    }

    // add first_time
    for (i = 0; i < this.trList.length; i++) {
        this.trList[i].classList.add("found-row")
    }

    this.init_pagination();
}

const createNavDiv = () => {
    var navDiv = document.createElement("div");
    navDiv.className = "navigation_btns";

    var prevDiv = document.createElement("div");
    var buttonPrev = document.createElement("button");
    buttonPrev.href = "#";
    buttonPrev.className = "_btn _red_btn previous round";
    buttonPrev.innerHTML = "&#8249;";
    prevDiv.appendChild(buttonPrev);

    var nextDiv = document.createElement("div");
    var buttonNext = document.createElement("button");
    buttonNext.href = "#";
    buttonNext.className = "_btn _red_btn next round";
    buttonNext.innerHTML = "&#8250;";
    nextDiv.appendChild(buttonNext);
    
    navDiv.appendChild(prevDiv);
    navDiv.appendChild(nextDiv);

    return navDiv;
}

var advancedTables = {};

tables.forEach(tableName => {
    var rows;
    if (tableName == "cadre") {
        rows = cadreDefault;
    } else {
        rows = eval(document.currentScript.getAttribute(tableName+'-rows'));
    }   

    advancedTables[tableName] = new advanced_table(tableName, rows || defaultMax)
});


function search(tableName = "cadre") {
    advancedTables[tableName].search();
}