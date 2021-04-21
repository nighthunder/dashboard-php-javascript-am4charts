// Forms Multi Select

import "select2";

$(document).ready(() => {
  setTimeout(function () {
    $(".multiselect-dropdown").select2({
      // dir: "rtl",
      theme: "bootstrap4",
      placeholder: "Select an option",
    });
  }, 2000);
});
