<?php
include("header.php");
if(!isset($_SESSION['email'])){
    echo "<script>window.location.assign('adminlogin.php?msg=Please Login!!')</script>";
}
$email=$_SESSION['email'];
?>

<style>
  /* page spacing because header fixed-top */
  .page-wrap{
    padding: 110px 12px 40px;
  }

  .table-card{
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.06);
    overflow: hidden;
  }

  .table-responsive-custom{
    width: 100%;
    overflow-x: auto; /* ✅ table scroll only inside */
    -webkit-overflow-scrolling: touch;
  }

  table.table{
    min-width: 1150px; /* ✅ preserve structure, wrapper scrolls on mobile */
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
    font-weight: 600;
    border: 1px solid rgba(0,0,0,0.08);
  }
  .badge-pending{
    background: rgba(255,193,7,0.18);
    color: #8a5a00;
  }
  .badge-assigned{
    background: rgba(40,167,69,0.16);
    color: #0f6b2a;
  }

  .assign-btn{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(40,167,69,0.12);
    border: 1px solid rgba(40,167,69,0.22);
    text-decoration: none;
    transition: 0.15s ease;
  }
  .assign-btn:hover{
    background: rgba(40,167,69,0.18);
    transform: translateY(-1px);
  }

  @media (max-width: 576px){
    .page-wrap{ padding: 95px 10px 30px; }
    .food-img{ width: 90px; height: 90px; border-radius: 10px; }
    .text-wrap{ max-width: 220px; }
  }
</style>

<div class="page-wrap">
  <div class="container">

    <h1 class="text-center mb-4" style="color:#111;font-weight:700;">View Donation</h1>

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
              <th>Food Image</th>
              <th>Description</th>
              <th>Mfg date</th>
              <th>Expiry date</th>
              <th>Pickup address</th>
              <th>NGO Name</th>
              <th>Status</th>
              <th>Assign</th>
            </tr>
          </thead>

          <tbody>
          <?php
            include("config.php");
            $query="SELECT * from `food`";
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
                  alt="Food Image"
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

              <td class="text-wrap">
                <?php
                  if($data['status']=='Pending'){
                    echo "<span class='text-muted'>Not Assigned Yet!!</span>";
                  } else {
                    echo "<strong>".$data['ngo_name']."</strong>";
                  }
                ?>
              </td>

              <td>
                <?php
                  if($data['status']=='Pending'){
                    echo "<span class='badge-status badge-pending'>Pending</span>";
                  } else {
                    echo "<span class='badge-status badge-assigned'>".$data['status']."</span>";
                  }
                ?>
              </td>

              <?php if($data['status']=='Pending'){ ?>
                <td class="text-center">
                  <a class="assign-btn" href="assign_ngo.php?id=<?php echo $data['id']?>" title="Assign NGO">
                    <i class="bi bi-plus-circle" style="color:green;font-size:22px;"></i>
                  </a>
                </td>
              <?php } else { ?>
                <td class="text-wrap">
                  Assigned To <strong><?php echo $data['ngo_name']?></strong>
                </td>
              <?php } ?>

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
