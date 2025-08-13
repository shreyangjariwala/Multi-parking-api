<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🚗 Multi-Level Parking Admin</title>
  <link rel="stylesheet" href="public/style.css">
</head>
<body>
  <header class="topbar">
    <h1>🚗 Multi-Level Parking Management</h1>
    <nav class="tabs" id="tabs">
      <button onclick="loadAll()">All Parkings</button>
      <button onclick="addParking()">Add Parking</button>
    </nav>
  </header>

  <main>
    <section id="content"></section>
    <section class="log">
      <div id="log" style="min-height:300px; color:#fff; padding:35px; border-radius:5px; overflow:auto;"></div>
    </section>
  </main>

  <script>
    function log(msg) {
      document.getElementById("log").innerHTML += "<div>" + msg + "</div>";
    }

    function loadAll() {
      fetch("readall_parking.php")
        .then(res => res.json())
        .then(data => {
          let html = "<table border='1'><tr><th>ID</th><th>Vehicle</th><th>Floor</th><th>Slot</th><th>Status</th></tr>";
          data.forEach(p => {
            html += `<tr>
              <td>${p.id}</td>
              <td>${p.vehicle_number}</td>
              <td>${p.floor}</td>
              <td>${p.slot}</td>
              <td>${p.status}</td>
            </tr>`;
          });
          html += "</table>";
          document.getElementById("content").innerHTML = html;
          log("Loaded all parkings");
        });
    }

    function addParking() {
      let vehicle = prompt("Vehicle Number:");
      let floor = prompt("Floor Number:");
      let slot = prompt("Slot Number:");
      fetch("create_parking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ vehicle_number: vehicle, floor: floor, slot: slot })
      })
      .then(res => res.json())
      .then(data => log(JSON.stringify(data)));
    }

    loadAll();
  </script>
</body>
</html>
