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