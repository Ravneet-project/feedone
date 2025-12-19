<?php
include("header.php");
include("config.php");

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
  echo "<script>window.location.assign('view_ngo_user.php')</script>";
  exit;
}

$id = (int)$_GET['id'];

/* NGO data */
$query = "SELECT * FROM `ngo` WHERE `id`=$id";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_assoc($result);

if(!$data){
  echo "<script>window.location.assign('view_ngo_user.php?msg=NGO not found')</script>";
  exit;
}

$name  = $data['ngo_name'];
$thumb = $data['thumbnail'];
$email = $data['email'];
$desc  = $data['description'];
$addr  = $data['address'];

$nameSafe = mysqli_real_escape_string($connect, $name);

/* ✅ NGO donation stats from food table */
$qTotal = mysqli_query($connect, "SELECT COUNT(*) AS total FROM food WHERE ngo_name='$nameSafe'");
$totalAssigned = (int) mysqli_fetch_assoc($qTotal)['total'];

$qPending = mysqli_query($connect, "SELECT COUNT(*) AS total FROM food WHERE ngo_name='$nameSafe' AND status!='Donated'");
$pendingCount = (int) mysqli_fetch_assoc($qPending)['total'];

$qDone = mysqli_query($connect, "SELECT COUNT(*) AS total FROM food WHERE ngo_name='$nameSafe' AND status='Donated'");
$donatedCount = (int) mysqli_fetch_assoc($qDone)['total'];
?>

<style>
  .detail-wrap{ padding: 110px 12px 55px; }

  .detail-shell{
    background: linear-gradient(135deg, rgba(13,110,253,0.10), rgba(111,66,193,0.10));
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 18px;
    padding: 16px;
    box-shadow: 0 12px 32px rgba(0,0,0,0.10);
  }

  .detail-card{
    background: rgba(255,255,255,0.95);
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 10px 26px rgba(0,0,0,0.08);
  }

  .top-grid{
    display: grid;
    grid-template-columns: 0.95fr 1.05fr;
    gap: 16px;
    padding: 16px;
  }

  .ngo-photo{
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    min-height: 320px;
    border: 1px solid rgba(0,0,0,0.06);
  }
  .ngo-photo img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display:block;
    transform: scale(1.02);
  }
  .ngo-photo::after{
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.0) 45%, rgba(0,0,0,0.65));
  }
  .ngo-photo .photo-title{
    position:absolute;
    left: 14px;
    right: 14px;
    bottom: 12px;
    z-index: 2;
    color: #fff;
  }
  .photo-title h2{
    margin: 0;
    font-weight: 950;
    font-size: 26px;
    line-height: 1.2;
  }
  .verified-chip{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    margin-top: 8px;
    padding: 7px 12px;
    border-radius: 999px;
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.25);
    font-weight: 900;
    font-size: 13px;
  }

  .ngo-info{
    border-radius: 18px;
    padding: 14px;
    border: 1px solid rgba(0,0,0,0.06);
    background: rgba(245,247,250,0.65);
    height: 100%;
  }

  .info-row{
    display:grid;
    grid-template-columns: 1fr;
    gap: 12px;
  }
  .info-box{
    border-radius: 16px;
    padding: 12px 14px;
    border: 1px solid rgba(0,0,0,0.06);
    background: rgba(255,255,255,0.92);
  }
  .info-box small{
    display:block;
    color:#6c757d;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .35px;
    margin-bottom: 6px;
    font-size: 12px;
  }
  .info-box .val{
    color:#111;
    font-weight: 850;
    word-break: break-word;
  }

  .stats-row{
    margin-top: 12px;
    display:grid;
    grid-template-columns: repeat(3, minmax(0,1fr));
    gap: 12px;
  }
  .stat{
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 16px;
    padding: 12px;
    box-shadow: 0 10px 22px rgba(0,0,0,0.06);
  }
  .stat .num{
    font-size: 22px;
    font-weight: 950;
    color:#111;
    line-height: 1;
  }
  .stat .lbl{
    margin-top: 6px;
    font-weight: 850;
    color:#5b6470;
    font-size: 13px;
  }

  .actions{
    margin-top: 14px;
    display:flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  .btn-soft{
    padding: 10px 14px;
    border-radius: 999px;
    border: 1px solid rgba(0,0,0,0.10);
    background: #fff;
    font-weight: 900;
    text-decoration:none;
    color:#111;
    display:inline-flex;
    align-items:center;
    gap: 8px;
    transition: .2s ease;
  }
  .btn-soft:hover{
    background:#f8f9fa;
    transform: translateY(-1px);
  }

  .btn-primary-soft{
    background: rgba(13,110,253,0.12);
    border-color: rgba(13,110,253,0.25);
    color:#0d6efd;
  }
  .btn-primary-soft:hover{
    background: rgba(13,110,253,0.18);
  }

  .btn-success-soft{
    background: rgba(25,135,84,0.14);
    border-color: rgba(25,135,84,0.25);
    color:#0f6b2a;
  }
  .btn-success-soft:hover{
    background: rgba(25,135,84,0.20);
  }

  .desc-sec{
    padding: 0 16px 16px;
  }
  .section{
    margin-top: 14px;
    border-top: 1px solid rgba(0,0,0,0.06);
    padding-top: 14px;
  }
  .section h4{
    font-weight: 950;
    color:#111;
    margin-bottom: 8px;
  }
  .section p{
    color:#4b5563;
    line-height: 1.7;
    margin: 0;
  }

  /* Responsive */
  @media (max-width: 991px){
    .top-grid{ grid-template-columns: 1fr; }
    .ngo-photo{ min-height: 260px; }
    .stats-row{ grid-template-columns: 1fr; }
  }

  @media (max-width: 576px){
    .detail-wrap{ padding: 95px 10px 45px; }
    .photo-title h2{ font-size: 20px; }
  }
</style>

<div class="detail-wrap">
  <div class="container">

    <div class="detail-shell">
      <div class="detail-card">

        <div class="top-grid">
          <!-- LEFT IMAGE -->
          <div class="ngo-photo">
            <img src="images/<?php echo $thumb; ?>" alt="<?php echo htmlspecialchars($name); ?>">
            <div class="photo-title">
              <h2><?php echo htmlspecialchars($name); ?></h2>
              <div class="verified-chip">
                <i class="bi bi-patch-check-fill"></i>
                Verified NGO
              </div>
            </div>
          </div>

          <!-- RIGHT INFO -->
          <div class="ngo-info">

            <div class="info-row">
              <div class="info-box">
                <small>Email</small>
                <div class="val"><?php echo htmlspecialchars($email); ?></div>
              </div>

              <div class="info-box">
                <small>Address</small>
                <div class="val"><?php echo htmlspecialchars($addr); ?></div>
              </div>
            </div>

            <!-- Stats -->
            <div class="stats-row">
              <div class="stat">
                <div class="num"><?php echo $totalAssigned; ?></div>
                <div class="lbl">Assigned Donations</div>
              </div>
              <div class="stat">
                <div class="num"><?php echo $pendingCount; ?></div>
                <div class="lbl">Pending</div>
              </div>
              <div class="stat">
                <div class="num"><?php echo $donatedCount; ?></div>
                <div class="lbl">Completed</div>
              </div>
            </div>

            <!-- Actions -->
            <div class="actions">
              <a class="btn-soft btn-success-soft" href="add_food.php">
                <i class="bi bi-bag-heart"></i> Donate Now
              </a>

              <a class="btn-soft btn-primary-soft" href="user_enquiry.php">
                <i class="bi bi-chat-left-text"></i> Contact
              </a>

              <a class="btn-soft" href="view_ngo_user.php">
                <i class="bi bi-arrow-left"></i> Back to NGO List
              </a>
            </div>

          </div>
        </div>

        <!-- ABOUT SECTION -->
        <div class="desc-sec">
          <div class="section">
            <h4>About NGO</h4>
            <p><?php echo nl2br(htmlspecialchars($desc)); ?></p>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<?php include("footer.php"); ?>
