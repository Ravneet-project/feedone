<?php
include("header.php");
?>
    <div class="container my-5">
        <h1 class="text-center">View Status</h1>
      
        <?php
       
        if(isset($_GET['msg'])){
          ?>
          <div class="alert alert-success"><?php echo $_GET['msg']?></div>
          <?php  
        }
        ?>
        <table class="table table-bordered table-striped" >
       
            <tr>
                <th>SNO</th>
                <th>NGO Name</th>
                <th>Status</th> 
               
            </tr>
            <?php
                include("config.php");
                $query="SELECT * from `ngo`";
                $result=mysqli_query($connect,$query);
                $sno=1;
               while($data=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $sno;?></td>
                    <td><?php echo $data['ngo_name']?></td>
                  
                    <td><?php echo $data['status']?></td>
                
                   
                </tr>
            <?php
            $sno++;
            }
            ?>
        </table>
    </div>
<?php
include("footer.php");
?>