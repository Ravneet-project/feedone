<?php
include("header.php");
if(!isset($_SESSION['email'])){
    echo "<script>window.location.assign('adminlogin.php?msg=Please Login!!')</script>";
}
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
    overflow-x: auto; /* ✅ mobile swipe inside table */
    -webkit-overflow-scrolling: touch;
  }

  table.table{
    min-width: 1050px; /* ✅ wide columns; wrapper handles small screens */
    margin-bottom: 0;
  }

  th{ white-space: nowrap; }
  td{ vertical-align: top; }

  .text-wrap{
    max-width: 280px;
    white-space: normal;
    word-break: break-word;
    line-height: 1.4;
  }

  /* clamp long text cleanly */
  .clamp-3{
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .badge-type{
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid rgba(0,0,0,0.08);
    background: rgba(13,110,253,0.10);
    color: #0b5ed7;
    text-transform: capitalize;
  }

  @media (max-width: 576px){
    .page-wrap{ padding: 95px 10px 30px; }
    .text-wrap{ max-width: 230px; }
  }
</style>

<div class="page-wrap">
  <div class="container">

    <h1 class="text-center mb-4" style="color:#111;font-weight:700;">Enquiry</h1>

    <?php if(isset($_GET['msg'])){ ?>
      <div class="alert alert-success"><?php echo $_GET['msg']?></div>
    <?php } ?>

    <div class="card table-card">
      <div class="table-responsive-custom">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>SNO</th>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>User type</th>
            </tr>
          </thead>

          <tbody>
          <?php
            include("config.php");
            $query="SELECT * from `enquiry`";
            $result=mysqli_query($connect,$query);
            $sno=1;

            while($data=mysqli_fetch_array($result)){
          ?>
            <tr>
              <td><?php echo $sno;?></td>

              <td class="text-wrap">
                <strong><?php echo $data['name']?></strong>
              </td>

              <td class="text-wrap">
                <?php echo $data['email']?>
              </td>

              <td class="text-wrap">
                <div class="clamp-3"><?php echo $data['subject']?></div>
              </td>

              <td class="text-wrap">
                <div class="clamp-3"><?php echo $data['message']?></div>
              </td>

              <td>
                <span class="badge-type"><?php echo $data['user_type']?></span>
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
