/**
 * File isotope.js
 *
 * Customized isotope script for Fields of Study Page
 */

jQuery(document).ready(function ($) {
  // Initially hide no result box
  $("#noResult").hide();

  let qsRegex;
  let filterArray = [];

  // Initialize Isotope
  const $grid = $("#isotope-list").isotope({
    itemSelector: ".item",
    layoutMode: "fitRows",
    stagger: 30,
    filter: function () {
      const $this = $(this);
      const searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      const filterResult = filterArray.length
        ? filterArray.every(f => $this.is(f))
        : true;
      return searchResult && filterResult;
    },
  });

  // === FILTER HANDLERS ===

  // Handle dropdown changes
  $("#filter-1, #filter-2").on("change", function () {
    const programType = $("#filter-1").val();
    const interestArea = $("#filter-2").val();

    filterArray = [programType, interestArea].filter(val => val); // remove empty
    updateHashFromFilters();
    $grid.isotope(); // Re-filter
  });

  $("#clear-filters").on("click", function (e) {
    e.preventDefault();
    $("#filter-1").val("");
    $("#filter-2").val("");
    filterArray = [];
    history.replaceState(null, null, " "); // clear hash without jump
    $grid.isotope();
  });

  // === HASH FUNCTIONS ===

  function updateHashFromFilters() {
    const programType = $("#filter-1").val()?.replace(/^\./, "") || "";
    const interestArea = $("#filter-2").val()?.replace(/^\./, "") || "";

    const params = new URLSearchParams();

    if (programType) params.set("program_type", programType);
    if (interestArea) params.set("interest_area", interestArea);

    location.hash = params.toString() ? "#" + params.toString() : "#";
  }

  function getFiltersFromHash() {
    const hash = location.hash.slice(1); // remove the #
    const params = new URLSearchParams(hash);

    const programType = params.get("program_type");
    const interestArea = params.get("interest_area");

    return {
      programType: programType ? "." + programType : "",
      interestArea: interestArea ? "." + interestArea : "",
    };
  }

  function onHashChange() {
    const filters = getFiltersFromHash();

    // Set selects
    $("#filter-1").val(filters.programType);
    $("#filter-2").val(filters.interestArea);

    // Update filter array for Isotope
    filterArray = [];
    if (filters.programType) filterArray.push(filters.programType);
    if (filters.interestArea) filterArray.push(filters.interestArea);

    $grid.isotope(); // Re-filter
  }

  // On page load and hash change
  onHashChange();
  window.onhashchange = onHashChange;

  // === SEARCH FILTER ===

  const $quicksearch = $("#id_search").keyup(
    debounce(function () {
      qsRegex = new RegExp($quicksearch.val(), "gi");
      $grid.isotope();

      // Show/hide no result message
      if (!$grid.data("isotope").filteredItems.length) {
        $("#noResult").show();
      } else {
        $("#noResult").hide();
      }
    })
  );

  function debounce(fn, threshold) {
    let timeout;
    return function debounced() {
      if (timeout) clearTimeout(timeout);
      timeout = setTimeout(fn, threshold || 100);
    };
  }

  // === Optional: Google Analytics Search Tracking ===

  (function () {
    const searchField = document.querySelector("#id_search");
    const timeout = 1500;
    const minLength = 3;

    let textEntered = false;
    let timer, searchText;

    const handleInput = function () {
      searchText = searchField ? searchField.value : "";
      if (searchText.length < minLength) return;

      window.dataLayer.push({
        event: "studyfieldsInput",
        searchTerm: searchText,
      });

      textEntered = false;
    };

    const startTimer = function (e) {
      textEntered = true;
      clearTimeout(timer);
      if (e.keyCode === 13) {
        handleInput();
        return;
      }
      timer = setTimeout(handleInput, timeout);
    };

    if (searchField !== null) {
      searchField.addEventListener("keydown", startTimer, true);
      searchField.addEventListener("blur", function () {
        if (textEntered) {
          clearTimeout(timer);
          handleInput();
        }
      }, true);
    }
  })();
});
