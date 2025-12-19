<?php
include("header.php");
include("config.php");
?>

<style>
  .ngo-page{ padding: 110px 12px 50px; }
  .ngo-title{ text-align:center; margin-bottom: 24px; }
  .ngo-title h1{ font-weight:900; color:#111; margin-bottom: 6px; }
  .ngo-title p{ color:#6c757d; max-width:720px; margin: 0 auto; }

  .ngo-search-wrap{
    max-width: 520px;
    margin: 18px auto 32px;
    position: relative;
  }
  .ngo-search{
    width: 100%;
    padding: 12px 44px 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(0,0,0,0.10);
    outline: none;
    box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    transition: .2s ease;
  }
  .ngo-search:focus{
    border-color: rgba(13,110,253,0.45);
    box-shadow: 0 14px 34px rgba(13,110,253,0.10);
  }
  .ngo-search-ico{
    position:absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color:#6c757d;
    font-size: 18px;
    pointer-events:none;
  }

  .ngo-card{
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
    background: rgba(255,255,255,0.96);
    box-shadow: 0 10px 28px rgba(0,0,0,0.08);
    transition: all .35s ease;
    height: 100%;
    cursor: pointer;
    position: relative;
  }
  .ngo-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 18px 45px rgba(0,0,0,0.16);
  }

  .ngo-img-wrap{ position: relative; overflow: hidden; }
  .ngo-img-wrap img{
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform .6s ease;
    display:block;
  }
  .ngo-card:hover .ngo-img-wrap img{ transform: scale(1.08); }

  .ngo-img-wrap::after{
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.60));
    opacity: 0;
    transition: opacity .35s ease;
  }
  .ngo-card:hover .ngo-img-wrap::after{ opacity: 1; }

  .ngo-body{
    padding: 18px;
    text-align: center;
  }
  .ngo-body h5{
    font-weight: 900;
    color:#111;
    margin-bottom: 8px;
  }
  .ngo-badge{
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 800;
    background: rgba(13,110,253,0.12);
    color: #0d6efd;
  }

  /* Hover button */
  .ngo-cta{
    position:absolute;
    left: 50%;
    bottom: 18px;
    transform: translateX(-50%);
    opacity: 0;
    transition: .3s ease;
    z-index: 2;
  }
  .ngo-card:hover .ngo-cta{ opacity: 1; transform: translateX(-50%) translateY(-4px); }

  .ngo-cta a{
    display:inline-block;
    padding: 10px 16px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 13px;
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(0,0,0,0.08);
    color:#111;
    text-decoration:none;
    box-shadow: 0 10px 24px rgba(0,0,0,0.12);
  }
  .ngo-cta a:hover{ background:#fff; }

  .no-results{
    display:none;
    text-align:center;
    padding: 30px 10px;
    color:#6c757d;
    font-weight:700;
  }

  @media (max-width: 576px){
    .ngo-page{ padding: 95px 10px 40px; }
    .ngo-img-wrap img{ height: 190px; }
  }
</style>

<div class="ngo-page">
  <div class="container">

    <div class="ngo-title">
      <h1>Our NGO’s</h1>
      <p>Meet our trusted NGOs working together to serve humanity.</p>
    </div>

    <div class="ngo-search-wrap">
      <input type="text" id="ngoSearch" class="ngo-search" placeholder="Search NGO by name...">
      <span class="ngo-search-ico"><i class="bi bi-search"></i></span>
    </div>

    <div class="row g-4" id="ngoGrid">
      <?php
      $query="SELECT * FROM `ngo` ORDER BY id DESC";
      $result=mysqli_query($connect,$query);

      while($data=mysqli_fetch_array($result)){
        $id = (int)$data['id'];
        $name = $data['ngo_name'];
        $thumb = $data['thumbnail'];
      ?>
        <div class="col-lg-4 col-md-6 col-sm-12 ngo-item" data-name="<?php echo htmlspecialchars(strtolower($name)); ?>">
          <div class="ngo-card" onclick="window.location.href='ngo_detail.php?id=<?php echo $id; ?>'">

            <div class="ngo-img-wrap">
              <img src="images/<?php echo $thumb; ?>" alt="<?php echo htmlspecialchars($name); ?>">
              <div class="ngo-cta">
                <a href="ngo_detail.php?id=<?php echo $id; ?>" onclick="event.stopPropagation();">
                  View Details <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>

            <div class="ngo-body">
              <h5><?php echo htmlspecialchars($name); ?></h5>
              <span class="ngo-badge">Verified NGO</span>
            </div>

          </div>
        </div>
      <?php } ?>
    </div>

    <div class="no-results" id="noResults">
      No NGO found. Try a different search.
    </div>

  </div>
</div>

<script>
  const searchInput = document.getElementById('ngoSearch');
  const items = document.querySelectorAll('.ngo-item');
  const noResults = document.getElementById('noResults');

  searchInput.addEventListener('input', function(){
    const q = this.value.trim().toLowerCase();
    let visibleCount = 0;

    items.forEach(item => {
      const name = item.getAttribute('data-name') || '';
      const show = name.includes(q);
      item.style.display = show ? '' : 'none';
      if(show) visibleCount++;
    });

    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
  });
</script>

<?php include("footer.php"); ?>
