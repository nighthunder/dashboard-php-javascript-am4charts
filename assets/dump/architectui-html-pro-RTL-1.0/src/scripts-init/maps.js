// Maps

import "jvectormap-next";

import GMaps from "gmaps";

$(document).ready(() => {
  // gMaps

  if (document.getElementById("gmap-example")) {
    var map = new GMaps({
      el: "#gmap-example",
      lat: -12.043333,
      lng: -77.028333,
      width: "100%",
      height: "300px",
    });
  }
});
