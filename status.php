<?php
include("header.php");

if(!isset($_SESSION['email']) || !isset($_SESSION['ngo_name'])){
    echo "<script>window.location.assign('ngo_login.php?msg=Please Login!!')</script>";
}

$ngo = $_SESSION['ngo_name'];
?>

<style>
  /* fixed header spacing */
  .page-wrap{
    padding: 110px 12px 40px;
  }

  .table-card{
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.06);
    overflow: hidden;
    background: #fff;
  }

  .table-responsive-custom{
    width: 100%;
    overflow-x: auto;            /* ✅ mobile swipe inside table */
    -webkit-overflow-scrolling: touch;
  }

  table.table{
    min-width: 1200px;           /* ✅ stable columns */
    margin-bottom: 0;
  }

  th{ white-space: nowrap; }
  td{ vertical-align: top; }

  .food-img{
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.08);
    background: #fff;
    display: block;
  }

  .text-wrap{
    max-width: 260px;
    white-space: normal;
    word-break: break-word;
    line-height: 1.4;
  }

  .clamp-3{
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .badge-status{
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    border: 1px solid rgba(0,0,0,0.08);
    text-transform: capitalize;
  }
  .badge-pending{
    background: rgba(255,193,7,0.18);
    color: #8a5a00;
  }
  .badge-donated{
    background: rgba(40,167,69,0.16);
    color: #0f6b2a;
  }

  .action-btn{
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display:flex;
    align-items:center;
    justify-content:center;
    border: 1px solid rgba(0,0,0,0.10);
    background: rgba(25,135,84,0.12);
    transition: .2s ease;
    text-decoration: none;
  }
  .action-btn:hover{
    transform: translateY(-1px);
    background: rgba(25,135,84,0.18);
  }
  .action-btn i{
    font-size: 22px;
    color: #198754;
  }

  @media (max-width: 576px){
    .page-wrap{ padding: 95px 10px 30px; }
    .food-img{ width: 90px; height: 90px; border-radius: 10px; }
    .text-wrap{ max-width: 220px; }
  }
</style>

<div class="page-wrap">
  <div class="container">

    <h1 class="text-center mb-4" style="color:#111;font-weight:800;">Donation</h1>

    <?php if(isset($_GET['msg'])){ ?>
      <div class="alert alert-success"><?php echo $_GET['msg']?></div>
    <?php } ?>

    <div class="card table-card">
      <div class="table-responsive-custom">

        <table class="table table-bordered table-striped text-capitalize">
          <thead>
            <tr>
              <th>SNO</th>
              <th>User Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Mfg date</th>
              <th>Expiry date</th>
              <th>Pickup address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
          <?php
            include("config.php");
            $ngoSafe = mysqli_real_escape_string($connect, $ngo);
            $query="SELECT * FROM `food` WHERE `ngo_name`='$ngoSafe' ORDER BY id DESC";
            $result=mysqli_query($connect,$query);

            $sno=1;
            while($data=mysqli_fetch_array($result)){
          ?>
            <tr>
              <td><?php echo $sno;?></td>

              <td class="text-wrap">
                <strong><?php echo $data['username']?></strong>
              </td>

              <td>
                <img
                  src="images/<?php echo $data['thumbnail']?>"
                  class="food-img"
                  alt="Donation Image"
                >
              </td>

              <td class="text-wrap">
                <div class="clamp-3"><?php echo $data['description']?></div>
              </td>

              <td><?php echo $data['mfg_date']?></td>
              <td><?php echo $data['exp_date']?></td>

              <td class="text-wrap">
                <div class="clamp-3"><?php echo $data['pickup_address']?></div>
              </td>

              <td>
                <?php
                  if($data['status'] == "Donated"){
                    echo "<span class='badge-status badge-donated'>Donated</span>";
                  } else {
                    echo "<span class='badge-status badge-pending'>".$data['status']."</span>";
                  }
                ?>
              </td>

              <td class="text-center">
                <?php if($data['status'] != "Donated"){ ?>
                  <a class="action-btn" href="update_status.php?id=<?php echo $data['id'] ?>" title="Mark as Donated">
                    <i class="fa fa-check"></i>
                  </a>
                <?php } else { ?>
                  <span class="badge-status badge-donated">Done</span>
                <?php } ?>
              </td>

            </tr>
          <?php
              $sno++;
            }
          ?>
          </tbody>

        </table>

      </div>
    </div>

  </div>
</div>

<?php include("footer.php"); ?>
