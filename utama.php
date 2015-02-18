<!-- slider -->
<div class="row">
    <div class="span8">
        <div class="title-divider">
            <h3>Selamat Datang Di Sistem Monitoring Ujian Akhir</h3>
            <div class="divider-arrow"></div>
        </div>
        <div id="mainslider" class="flexslider">
            <ul class="slides">
                <li>
                    <img src="images/sl3.jpg" alt='FH-UNIDAR' />
                    <h3><span>Selamat Datang</span>
                    <a href='#'>Sistem Monitoring Ujian Akhir FH-UNIDAR</a>
                    </h3>
                </li>
                <li>
                    <img src="images/sl3.jpg" alt='FH-UNIDAR' />
                    <h3><span>Selamat Datang</span>
                    <a href='#'>Sistem Monitoring Ujian Akhir FH-UNIDAR</a>
                    </h3>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- content -->
<?php
$info = mysql_fetch_array(mysql_query("SELECT * FROM info ORDER BY iId DESC"));
if (!empty($info['iId'])){
?>
<!-- info -->
<div class="row">
    <div class="span8">
        <div class="title-divider">
            <h3>Pengumuman Terakhir</h3>
            <div class="divider-arrow"></div>
        </div>
    </div>
    <div class="span8">
        <div class="block-grey wrap15">
            <section id="welcome">
                <div class="row">
                    <div class="span6">
                        <h1><?php echo $info['iJudul'];?></h1>
                        <p class="last"><?php echo $info['iIsi'];?></p>
                    </div>
                    <div class="span1 alignright clearfix">
                        <img alt="Info" src="images/info.png">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="spacer"></div>
</div>
<?php
}
?>
<!-- info -->