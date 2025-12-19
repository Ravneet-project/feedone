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
    overflow-x: auto;      /* ✅ horizontal scroll only if needed */
    -webkit-overflow-scrolling: touch;
  }

  table.table{
    min-width: 980px;      /* ✅ keeps structure, wrapper will scroll on mobile */
    margin-bottom: 0;
  }

  th{
    white-space: nowrap;
  }

  td{
    vertical-align: top;
  }

  .ngo-img{
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.08);
    background: #fff;
  }

  .text-wrap{
    max-width: 260px;      /* ✅ prevents ultra wide cells */
    white-space: normal;
    word-break: break-word;
    line-height: 1.4;
  }

  /* Optional: clamp long text (clean look) */
  .clamp-3{
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .btn-icon{
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
  }

  @media (max-width: 576px){
    .page-wrap{ padding: 95px 10px 30px; }
    .ngo-img{ width: 90px; height: 90px; border-radius: 10px; }
    .text-wrap{ max-width: 220px; }
  }
</style>

<div class="page-wrap">
  <div class="container">

    <h1 class="text-center mb-4" style="color:#111;font-weight:700;">View NGO</h1>

    <?php if(isset($_GET['msg'])){ ?>
      <div class="alert alert-success"><?php echo $_GET['msg']?></div>
    <?php } ?>

    <div class="card table-card">
      <div class="table-responsive-custom">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>SNO</th>
              <th>NGO Name</th>
              <th>NGO Image</th>
              <th>Email</th>
              <th>Description</th>
              <th>Address</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <?php
              include("config.php");
              $query="SELECT * from `ngo`";
              $result=mysqli_query($connect,$query);
              $sno=1;

              while($data=mysqli_fetch_array($result)){
            ?>
              <tr>
                <td><?php echo $sno;?></td>

                <td class="text-wrap">
                  <strong><?php echo $data['ngo_name']?></strong>
                </td>

                <td>
                  <img
                    src="images/<?php echo $data['thumbnail']?>"
                    class="ngo-img"
                    alt="NGO Image"
                  >
                </td>

                <td class="text-wrap">
                  <?php echo $data['email']?>
                </td>

                <td class="text-wrap">
                  <div class="clamp-3">
                    <?php echo $data['description']?>
                  </div>
                </td>

                <td class="text-wrap">
                  <div class="clamp-3">
                    <?php echo $data['address']?>
                  </div>
                </td>

                <td class="text-center">
                  <a href="update_ngo.php?id=<?php echo $data['id']?>" class="btn btn-success btn-icon" title="Edit">
                    <i class="fa fa-edit"></i>
                  </a>
                </td>

                <td class="text-center">
                  <a class="btn btn-danger btn-icon" href="delete_ngo.php?id=<?php echo $data['id']?>" title="Delete"
                     onclick="return confirm('Are you sure you want to delete this NGO?');">
                    <i class="fa fa-trash"></i>
                  </a>
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
