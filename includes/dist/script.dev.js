"use strict";

var galleryAPI = "../api-galleries.php";
var paintingAPI = "../api-paintings.php?galleryID=";
var map; // google map

function initMap() {
  map = new google.maps.Map(qs('#map'), {
    center: {
      lat: 41.89474,
      lng: 12.4839
    },
    zoom: 6
  });
} // helper functions query selector using passed query


function qs(query) {
  return document.querySelector(query);
} // helper functions query selector all using passed query


function qsa(query) {
  return document.querySelectorAll(query);
} // helper function creates element and sets text content


function ce(elementName, textContent) {
  var element = document.createElement(elementName);
  element.textContent = textContent;
  return element;
} // event handlers


document.addEventListener("DOMContentLoaded", function () {
  var container = qs('.container');
  var mapContainer = qs('#googleMap');
  var paintingContainer = qs('#paintingList');
  var infoContainer = qs('#galleryInfo');
  var galleryContainer = qs('#galleries');
  var paintingTable = qs('#paintings');
  var containers = [container, mapContainer, paintingContainer, infoContainer, galleryContainer, paintingTable];
  var galleryList = qs('#galleryList');
  var ascendArtist = true;
  var ascendTitle = true;
  var ascendYear = true; // array of paintings to sort etc.

  var paintings = [];
  fetch(galleryAPI).then(function (response) {
    return response.json();
  }).then(function (data) {
    finishAnimation(data);
  })["catch"](function (error) {
    return console.log(error);
  }); // hides the animation and shows the gallery list

  function finishAnimation(data) {
    qs('#loader').style.display = 'none'; // less paint displays the gallery list

    galleryList.classList.add('lessPaint');
    createGalleryList(data);
  } // creates the list of galleries


  function createGalleryList(galleryData) {
    console.log(galleryData); // add gallery names

    galleryData.forEach(function (gallery) {
      var li = document.createElement('li');
      var name = ce('span', gallery.GalleryName);
      name.classList.add('clickable'); // click event for gallery names

      name.addEventListener('click', function () {
        addGalleryInfo(gallery);
        centerMap(gallery.Latitude, gallery.Longitude);
        showPaintings(gallery.GalleryID); // variables for storing the sorting order

        ascendArtist, ascendTitle, ascendYear = true;
      });
      li.appendChild(name);
      galleryList.appendChild(li);
    });
    qs('#arrowBox').addEventListener('click', showMore);
  } // adds gallery info after clicking the gallery


  function addGalleryInfo(gallery) {
    var informationList = qs('#informationList');
    informationList.textContent = "";
    var li = document.createElement('li');
    li.appendChild(ce("h1", gallery.GalleryName));
    informationList.appendChild(li);
    informationList.appendChild(ce("li", gallery.GalleryNativeName));
    informationList.appendChild(ce("li", gallery.GalleryCity));
    informationList.appendChild(ce("li", gallery.GalleryAddress));
    informationList.appendChild(ce("li", gallery.GalleryCountry));
    var a = ce('a', gallery.GalleryWebSite);
    a.setAttribute('href', gallery.GalleryWebSite);
    informationList.appendChild(a);
    infoContainer.classList.add('lessPaint');
  } // click event to center the google map


  function centerMap(latitude, longitude) {
    // sets the map center to the gallery
    map.setCenter({
      lat: latitude,
      lng: longitude
    }); // sets the zoom to 18

    map.setZoom(18); // sets map type to satellite

    map.setMapTypeId('satellite'); // sets map height to 650px

    mapContainer.classList.add('lessPaint');
  } // fetches painting from api


  function showPaintings(GalleryID) {
    paintingContainer.classList.add('lessPaint');
    fetch(paintingAPI + GalleryID).then(function (response) {
      return response.json();
    }).then(function (data) {
      paintings = data;
      buildPaintingsTable();
    })["catch"](function (error) {
      return console.log(error);
    });
  } // creates the thumbails to add to the painting table


  function createThumbnail(painting, index) {
    var thumbnail = true;
    var td = document.createElement('td');
    var img = createImgElement(painting, thumbnail);
    td.appendChild(img);
    return td;
  } // creates the table of gallery images


  function buildPaintingsTable() {
    paintingTable.textContent = "";
    var tr = document.createElement('tr');
    tr.appendChild(ce('th', ""));
    tr.appendChild(createHeader(sortArtist, "Artist"));
    tr.appendChild(createHeader(sortTitle, "Title"));
    tr.appendChild(createHeader(sortYear, "Year"));
    paintingTable.appendChild(tr);
    loadPaintingTable();
  } // creates the image used in the table


  function createImgElement(painting, thumbnail) {
    var src = painting;
    var img = document.createElement('img');

    if (thumbnail) {
      img.classList.add('thumbnail');
    } else {
      img.classList.add('notThumbnail');
    }

    img.classList.add('clickable');
    img.id = painting.ImageFileName;
    img.setAttribute('src', src);
    img.setAttribute('alt', painting.Title);
    img.setAttribute('title', painting.Title);
    return img;
  } // creates the table header and adds the passed sort function


  function createHeader(sortFunction, nodeText) {
    var th = ce('th', '');
    var span = ce('span', nodeText);
    span.classList.add('clickable');
    span.addEventListener('click', sortFunction);
    th.appendChild(span);
    return th;
  } // loads all data into the gallery painting table and sets title to a link


  function loadPaintingTable() {
    for (var i = 0; i < paintings.length; i++) {
      var tr = document.createElement('tr');
      tr.appendChild(createThumbnail(paintings[i].ImageFileName, i));
      tr.appendChild(ce('td', paintings[i].LastName));
      var title = ce('td', paintings[i].Title);
      var link = ce('a', title);
      link.setAttribute('href', '../single-painting.php?PaintingID=${paintings[i].PaintingID}');
      tr.appendChild(title);
      tr.appendChild(ce('td', paintings[i].YearOfWork));
      paintingTable.appendChild(tr);
    }
  }

  function sortArtist() {
    sortPaintings("LastName", ascendArtist);
    buildPaintingsTable();
    ascendArtist = !ascendArtist;
  }

  function sortTitle() {
    sortPaintings("Title", ascendTitle);
    buildPaintingsTable();
    ascendTitle = !ascendTitle;
  }

  function sortYear() {
    sortPaintings("YearOfWork", ascendYear);
    buildPaintingsTable();
    ascendYear = !ascendYear;
  } // determines ascending or descending order of sorting


  function sortPaintings(sortBy, ascending) {
    paintings.sort(function (a, b) {
      if (ascending) {
        if (a[sortBy] > b[sortBy]) return 1;else return -1;
      } else {
        if (a[sortBy] < b[sortBy]) return 1;else return -1;
      }
    });
    ascending = !ascending;
  } // function used to expand painting table


  function showMore() {
    containers.forEach(function (container) {
      container.classList.add('morePaint');
      container.classList.remove('lessPaint');
    });
    qsa('#paintings img').forEach(function (img) {
      var src = paintingIMG.replace('/square', '').replace('SIZE', 'w_200').replace('FILENAME', img.id);
      img.src = src;
    });
    qsa('.more-less').forEach(function (arrow) {
      arrow.textContent = "→";
    });
    qs('#arrowBox').removeEventListener('click', showMore);
    qs('#arrowBox').addEventListener('click', showLess);
  }

  ;

  function showLess() {
    containers.forEach(function (container) {
      container.classList.add('lessPaint');
      container.classList.remove('morePaint');
    });
    qsa('#paintings img').forEach(function (img) {
      var src = paintingIMG.replace('SIZE', 'h_125').replace('FILENAME', img.id);
      img.src = src;
    });
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    qsa('.more-less').forEach(function (arrow) {
      arrow.textContent = "←";
    });
    qs('#arrowBox').removeEventListener('click', showLess);
    qs('#arrowBox').addEventListener('click', showMore);
  }
});