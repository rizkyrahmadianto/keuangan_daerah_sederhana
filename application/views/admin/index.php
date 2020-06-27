<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Region</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_region; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-globe-asia fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Good Region</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $good_region; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Warning Region</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $warning_region; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-exclamation fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Danger Region</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $danger_region; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-skull-crossbones fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">User Online</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user_online; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card col-md-12 shadow mb-4">
    <div class="card-body">
      <!-- <div id="dataMap" style='width: 400px; height: 300px;'></div> -->
      <div id="dataMap" style='width: auto; height: 500px;'></div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

<script>
  $(document).ready(function() {
    // Making a map and tiles
    var myMap = L.map('dataMap').setView([51.505, -0.09], 1);

    var attribution = '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
    var tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var tiles = L.tileLayer(tileUrl, attribution);
    tiles.addTo(myMap);

    var popup = L.popup()
      .setLatLng([-6.978581, 110.477068])
      .setContent('<p>Hello!<br />Please visit our office.</p>')
      .openOn(myMap);

    // Making a marker with a custom icon 
    var spaceCraftIcon = L.icon({
      iconUrl: '<?php echo base_url(); ?>assets/img/satellite.png',
      iconSize: [50, 50],
      iconAnchor: [25, 16]
    });

    var marker = L.marker([0, 0], {
      icon: spaceCraftIcon
    }).addTo(myMap);

    const issApiUrl = 'https://api.wheretheiss.at/v1/satellites/25544';

    let firstTime = true;

    async function getIss() {
      const response = await fetch(issApiUrl);
      const data = await response.json();
      const {
        latitude,
        longitude
      } = data;

      marker.setLatLng([latitude, longitude]);

      if (firstTime) {
        myMap.setView([latitude, longitude], 2);
      }
    }

    getIss();

    setInterval(getIss, 1000);
    /* L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1Ijoicml6a3ktcmFobWFkaWFudG8iLCJhIjoiY2tieGx0dHE0MDNnbjJydDZla2o1YzhzMSJ9.paBHWC6qgmx8_U4996mgZA'
    }).addTo(myMap); */
  })
</script>