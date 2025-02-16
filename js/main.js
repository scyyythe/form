let currentTab = 0;
      const tabs = document.querySelectorAll(".tab");

      function showTab(index) {
        tabs.forEach((tab, i) => {
          tab.classList.toggle("active", i === index);
        });
      }

      function nextTab() {
        if (currentTab < tabs.length - 1) {
          currentTab++;
          showTab(currentTab);
        }
      }

      function prevTab() {
        if (currentTab > 0) {
          currentTab--;
          showTab(currentTab);
        }
      }

      //other when clicked
      function clickOthers() {
        let civilStatusDropdown = document.getElementById("civilStatus");
        let otherStatusField = document.getElementById("otherStatus");
    
        if (civilStatusDropdown.value === "others") {
            otherStatusField.style.display = "block";
        } else {
            otherStatusField.style.display = "none";
        }
    }

    
    //table
    document.addEventListener("DOMContentLoaded", function () {
      const tableRows = document.querySelectorAll("tr");
  
      tableRows.forEach(tr => {
          tr.addEventListener("click", function (event) {
              event.stopPropagation();
              tableRows.forEach(row => row.classList.remove("selected"));
              this.classList.add("selected");
          });
      });
  
      document.addEventListener("click", function () {
          tableRows.forEach(row => row.classList.remove("selected"));
      });
  });
  