<?php
include("header.php");
if(!isset($_SESSION['email'])){
    echo "<script>window.location.assign('adminlogin.php?msg=Please Login!!')</script>";
}
include("config.php");

/* ===== Fetch Counts ===== */
$counts = [
  'donors'   => 0,
  'ngos'     => 0,
  'donation' => 0,
  'enquiry'  => 0
];

$q1 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `user`");
$counts['donors'] = (int) mysqli_fetch_assoc($q1)['total'];

$q2 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `ngo`");
$counts['ngos'] = (int) mysqli_fetch_assoc($q2)['total'];

$q3 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `food`");
$counts['donation'] = (int) mysqli_fetch_assoc($q3)['total'];

$q4 = mysqli_query($connect,"SELECT COUNT(*) AS total FROM `enquiry`");
$counts['enquiry'] = (int) mysqli_fetch_assoc($q4)['total'];

$chartLabels = ["Donors","NGOs","Donations","Enquiries"];
$chartData   = [$counts['donors'], $counts['ngos'], $counts['donation'], $counts['enquiry']];
?>

<style>
  /* ✅ Page scroll ON, horizontal OFF */
  html, body{
    height: auto;
    overflow-y: auto !important;
    overflow-x: hidden !important;
  }

  /* ✅ fixed header spacing */
  .dash-wrap{
    padding: 110px 12px 35px;
    overflow-x: hidden;
  }

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

  /* ✅ stats grid */
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

  /* ✅ charts panels */
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
    overflow: hidden;          /* ✅ IMPORTANT */
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

  /* ✅ KEY FIX: chart container fixed + canvas forced to 100% */
  .chart-box{
    position: relative;
    width: 100%;
    height: 320px;     /* enough for chart + legend */
  }
  .mini-chart-box{
    position: relative;
    width: 100%;
    height: 170px;     /* mini charts */
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

  /* ✅ tablet */
  @media (max-width: 991px){
    .stat-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
    .dash-panels{ grid-template-columns: 1fr; }
    .chart-box{ height: 300px; }
    .mini-chart-box{ height: 170px; }
  }

  /* ✅ mobile */
  @media (max-width: 576px){
    .dash-wrap{ padding: 95px 10px 30px; }
    .dash-title h2{ font-size: 22px; }
    .stat-grid{ grid-template-columns: 1fr; }
    .chart-box{ height: 290px; }       /* ✅ slightly bigger to fit legend */
    .mini-chart-box{ height: 160px; }
  }
</style>

<div class="dash-wrap">
  <div class="container">

    <div class="dash-hero">
      <div class="dash-title text-center">
        <small>Dashboard</small>
        <h2>Welcome Admin</h2>
        <p class="dash-sub">Quick overview of donors, NGOs, donations and enquiries.</p>
      </div>

      <!-- ✅ Stat Cards -->
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
            <div class="stat-label">Donations</div>
          </div>
          <div class="stat-ico" style="background: rgba(255,193,7,0.14);">
            <i class="bi bi-bag-heart" style="color:#b88600;"></i>
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-num"><?php echo $counts['enquiry']; ?></div>
            <div class="stat-label">Enquiries</div>
          </div>
          <div class="stat-ico" style="background: rgba(111,66,193,0.12);">
            <i class="bi bi-chat-left-text" style="color:#6f42c1;"></i>
          </div>
        </div>

      </div>

      <!-- ✅ Charts -->
      <div class="dash-panels">

        <div class="panel">
          <div class="panel-title">
            <h5>Overall Distribution</h5>
            <span>Doughnut Chart</span>
          </div>
          <div class="chart-box">
            <canvas id="overallChart"></canvas>
          </div>
        </div>

        <div class="mini-grid">

          <div class="panel">
            <div class="panel-title">
              <h5>Donors vs NGOs</h5>
              <span>Pie</span>
            </div>
            <div class="mini-chart-box">
              <canvas id="donorNgoChart"></canvas>
            </div>
          </div>

          <div class="panel">
            <div class="panel-title">
              <h5>Donations vs Enquiries</h5>
              <span>Pie</span>
            </div>
            <div class="mini-chart-box">
              <canvas id="donationEnquiryChart"></canvas>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>
</div>

<?php include("footer.php"); ?>

<!-- ✅ Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- ✅ Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
  const labels  = <?php echo json_encode($chartLabels); ?>;
  const dataVals = <?php echo json_encode($chartData); ?>;

  // ✅ Compact legend
  const legendCompact = {
    position: 'bottom',
    labels: {
      boxWidth: 10,
      boxHeight: 10,
      padding: 10,
      font: { size: 11 }
    }
  };

  const baseOptions = {
    responsive: true,
    maintainAspectRatio: false,
    layout: { padding: { top: 0, right: 0, bottom: 0, left: 0 } },
    plugins: {
      legend: legendCompact,
      tooltip: { enabled: true }
    }
  };

  /* =========================
     1) Overall Doughnut
  ========================== */
  new Chart(document.getElementById('overallChart'), {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        data: dataVals,
        borderWidth: 1
      }]
    },
    options: {
      ...baseOptions,
      cutout: '62%'
    }
  });

  /* =========================
     2) Donors vs NGOs (Pie)
  ========================== */
  new Chart(document.getElementById('donorNgoChart'), {
    type: 'pie',
    data: {
      labels: ['Donors','NGOs'],
      datasets: [{
        data: [dataVals[0], dataVals[1]],
        borderWidth: 1
      }]
    },
    options: baseOptions
  });

  /* =========================
     3) Donations vs Enquiries (LINE CHART)
     (Currently shows current values as a simple comparison line)
  ========================== */
  new Chart(document.getElementById('donationEnquiryChart'), {
    type: 'line',
    data: {
      labels: ['Donations', 'Enquiries'],
      datasets: [{
        label: 'Count',
        data: [dataVals[2], dataVals[3]],
        tension: 0.35,     // smooth curve
        fill: false,
        borderWidth: 3,
        pointRadius: 5,
        pointHoverRadius: 6
      }]
    },
    options: {
      ...baseOptions,
      plugins: {
        ...baseOptions.plugins,
        legend: { position: 'bottom' } // line me label show
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { precision: 0 }
        }
      }
    }
  });
</script>

