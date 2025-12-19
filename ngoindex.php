<?php
include("header.php");
if(!isset($_SESSION['email'])){
    echo "<script>window.location.assign('ngo_login.php?msg=Please Login!!')</script>";
}
include("config.php");

$ngoName = $_SESSION['ngo_name'];
$ngoSafe = mysqli_real_escape_string($connect, $ngoName);

/* ===== Fetch Counts ===== */
$counts = [
  'donors'   => 0,
  'ngos'     => 0,
  'donation' => 0,
  'assigned' => 0
];

$q1 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `user`");
$counts['donors'] = (int) mysqli_fetch_assoc($q1)['total'];

$q2 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `ngo`");
$counts['ngos'] = (int) mysqli_fetch_assoc($q2)['total'];

$q3 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `food`");
$counts['donation'] = (int) mysqli_fetch_assoc($q3)['total'];

$q4 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `food` WHERE `ngo_name`='$ngoSafe'");
$counts['assigned'] = (int) mysqli_fetch_assoc($q4)['total'];

/* ==========================================================
   ✅ Real last 7 days data using created_at (LINE CHART)
========================================================== */
$days = [];
for($i=6; $i>=0; $i--){
  $days[] = date('Y-m-d', strtotime("-$i days"));
}

/* Total donations per day */
$totalDaily = [];
$sqlTotal = "
  SELECT DATE(created_at) as d, COUNT(*) as c
  FROM food
  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
  GROUP BY DATE(created_at)
";
$resTotal = mysqli_query($connect, $sqlTotal);
$mapTotal = [];
while($row = mysqli_fetch_assoc($resTotal)){
  $mapTotal[$row['d']] = (int)$row['c'];
}
foreach($days as $d){
  $totalDaily[] = $mapTotal[$d] ?? 0;
}

/* Assigned to THIS NGO per day */
$assignedDaily = [];
$sqlAssigned = "
  SELECT DATE(created_at) as d, COUNT(*) as c
  FROM food
  WHERE ngo_name = '$ngoSafe'
    AND created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
  GROUP BY DATE(created_at)
";
$resAssigned = mysqli_query($connect, $sqlAssigned);
$mapAssigned = [];
while($row = mysqli_fetch_assoc($resAssigned)){
  $mapAssigned[$row['d']] = (int)$row['c'];
}
foreach($days as $d){
  $assignedDaily[] = $mapAssigned[$d] ?? 0;
}

/* Chart labels in nice format (Mon, Tue...) */
$dayLabels = array_map(function($d){
  return date('D', strtotime($d));
}, $days);

/* Pie/Doughnut data */
$chartData = [$counts['donors'], $counts['ngos'], $counts['donation'], $counts['assigned']];
?>

<style>
  html, body{
    height: auto;
    overflow-y: auto !important;
    overflow-x: hidden !important;
  }

  .dash-wrap{ padding: 110px 12px 35px; overflow-x: hidden; }

  .dash-hero{
    background: linear-gradient(135deg, rgba(13,110,253,0.10), rgba(111,66,193,0.10));
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 12px 32px rgba(0,0,0,0.08);
  }

  .dash-title small{
    display:inline-block;
    font-weight:800;
    letter-spacing:.6px;
    text-transform:uppercase;
    color:#6c757d;
  }
  .dash-title h2{
    margin: 8px 0 0;
    font-weight: 900;
    color:#111;
    font-size: 30px;
  }
  .dash-sub{
    margin: 8px auto 0;
    color:#5b6470;
    max-width: 720px;
    font-weight: 600;
  }

  .stat-grid{
    margin-top: 16px;
    display:grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 14px;
  }

  .stat-card{
    background: rgba(255,255,255,0.86);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 16px;
    padding: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 12px;
    backdrop-filter: blur(10px);
  }

  .stat-num{ font-size: 28px; font-weight: 900; color:#111; line-height: 1; }
  .stat-label{ font-weight: 700; color:#5b6470; font-size: 14px; margin-top: 4px; }

  .stat-ico{
    width: 44px; height: 44px; border-radius: 14px;
    display:flex; align-items:center; justify-content:center;
    border: 1px solid rgba(0,0,0,0.06);
    flex: 0 0 auto;
  }
  .stat-ico i{ font-size: 20px; }

  .dash-panels{
    margin-top: 14px;
    display:grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 14px;
  }

  .panel{
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.07);
    padding: 14px;
    overflow: hidden;
  }

  .panel-title{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 10px;
    margin-bottom: 10px;
  }
  .panel-title h5{
    margin:0;
    font-weight: 900;
    color:#111;
    font-size: 16px;
  }
  .panel-title span{
    font-size: 12px;
    color:#6c757d;
    font-weight: 700;
    white-space: nowrap;
  }

  .chart-box{
    position: relative;
    width: 100%;
    height: 320px;
  }
  .mini-chart-box{
    position: relative;
    width: 100%;
    height: 170px;
  }

  .chart-box canvas,
  .mini-chart-box canvas{
    width: 100% !important;
    height: 100% !important;
    display: block !important;
  }

  .mini-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap: 14px;
  }

  @media (max-width: 991px){
    .stat-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
    .dash-panels{ grid-template-columns: 1fr; }
    .chart-box{ height: 300px; }
    .mini-chart-box{ height: 190px; } /* line chart needs more space */
  }

  @media (max-width: 576px){
    .dash-wrap{ padding: 95px 10px 30px; }
    .dash-title h2{ font-size: 22px; }
    .stat-grid{ grid-template-columns: 1fr; }
    .chart-box{ height: 290px; }
    .mini-chart-box{ height: 190px; }
  }
</style>

<div class="dash-wrap">
  <div class="container">

    <div class="dash-hero">
      <div class="dash-title text-center">
        <small>Dashboard</small>
        <h2>Welcome <?php echo htmlspecialchars($ngoName); ?></h2>
        <p class="dash-sub">Last 7 days donation analytics (real-time from created_at).</p>
      </div>

      <!-- Stat Cards -->
      <div class="stat-grid">

        <div class="stat-card">
          <div>
            <div class="stat-num"><?php echo $counts['donors']; ?></div>
            <div class="stat-label">Number of Donors</div>
          </div>
          <div class="stat-ico" style="background: rgba(13,110,253,0.10);">
            <i class="bi bi-people" style="color:#0d6efd;"></i>
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-num"><?php echo $counts['ngos']; ?></div>
            <div class="stat-label">NGO Connected</div>
          </div>
          <div class="stat-ico" style="background: rgba(25,135,84,0.12);">
            <i class="bi bi-building" style="color:#198754;"></i>
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-num"><?php echo $counts['donation']; ?></div>
            <div class="stat-label">Total Donations</div>
          </div>
          <div class="stat-ico" style="background: rgba(255,193,7,0.14);">
            <i class="bi bi-bag-heart" style="color:#b88600;"></i>
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-num"><?php echo $counts['assigned']; ?></div>
            <div class="stat-label">Assigned to You</div>
          </div>
          <div class="stat-ico" style="background: rgba(111,66,193,0.12);">
            <i class="bi bi-check2-circle" style="color:#6f42c1;"></i>
          </div>
        </div>

      </div>

      <!-- Charts -->
      <div class="dash-panels">

        <!-- Overall Doughnut -->
        <div class="panel">
          <div class="panel-title">
            <h5>Overall Distribution</h5>
            <span>Doughnut</span>
          </div>
          <div class="chart-box">
            <canvas id="overallChart"></canvas>
          </div>
        </div>

        <div class="mini-grid">

          <!-- Pie -->
          <div class="panel">
            <div class="panel-title">
              <h5>Donors vs NGOs</h5>
              <span>Pie</span>
            </div>
            <div class="mini-chart-box">
              <canvas id="donorNgoChart"></canvas>
            </div>
          </div>

          <!-- Real Line -->
          <div class="panel">
            <div class="panel-title">
              <h5>Last 7 Days Trend</h5>
              <span>Line</span>
            </div>
            <div class="mini-chart-box">
              <canvas id="weeklyTrendChart"></canvas>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>
</div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
  const overallData = <?php echo json_encode($chartData); ?>;

  const weekLabels = <?php echo json_encode($dayLabels); ?>;
  const totalDaily = <?php echo json_encode($totalDaily); ?>;
  const assignedDaily = <?php echo json_encode($assignedDaily); ?>;

  const legendCompact = {
    position: 'bottom',
    labels: { boxWidth: 10, boxHeight: 10, padding: 10, font: { size: 11 } }
  };

  const baseOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: legendCompact, tooltip: { enabled: true } }
  };

  // Doughnut
  new Chart(document.getElementById('overallChart'), {
    type: 'doughnut',
    data: {
      labels: ['Donors','NGOs','Donations','Assigned'],
      datasets: [{ data: overallData, borderWidth: 1 }]
    },
    options: { ...baseOptions, cutout: '62%' }
  });

  // Pie
  new Chart(document.getElementById('donorNgoChart'), {
    type: 'pie',
    data: {
      labels: ['Donors','NGOs'],
      datasets: [{ data: [overallData[0], overallData[1]], borderWidth: 1 }]
    },
    options: baseOptions
  });

  // ✅ Real weekly trend line
  new Chart(document.getElementById('weeklyTrendChart'), {
    type: 'line',
    data: {
      labels: weekLabels,
      datasets: [
        {
          label: 'Total Donations',
          data: totalDaily,
          tension: 0.35,
          fill: false,
          borderWidth: 3,
          pointRadius: 4,
          pointHoverRadius: 5
        },
        {
          label: 'Assigned to You',
          data: assignedDaily,
          tension: 0.35,
          fill: false,
          borderWidth: 3,
          pointRadius: 4,
          pointHoverRadius: 5
        }
      ]
    },
    options: {
      ...baseOptions,
      scales: {
        y: { beginAtZero: true, ticks: { precision: 0 } }
      }
    }
  });
</script>
