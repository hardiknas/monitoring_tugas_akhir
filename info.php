<!-- education news -->
<div class="row">
    <div class="span8 education-news">
        <div class="title-divider">
            <h3>Info & Pengumuman</h3>
            <div class="divider-arrow"></div>
        </div>
        <div class="block-grey">
            <?php
            $p1     = new PagingInfo;
            $batas  = 14;
            $posisi = $p1->cariPosisi($batas);
            $qinfo = mysql_query("SELECT * FROM info ORDER BY iId DESC LIMIT $posisi,$batas");
            while ($ar = mysql_fetch_array($qinfo)){
                $link = "#";
                $judul = $ar['iJudul'];
                $tgl = getTglIndo($ar['tgl']);
                $isi_berita = $ar['iIsi'];
                $isi = $isi_berita;
                echo "
                    <div class='block-light wrap15'>
                    <div class='row'>
                        <div class='span7'>
                            <h2 class='post-title'><a href='$link'>$judul</a></h2>
                            <h6>Pada $tgl</h6>
                            <p>
                                $isi
                            </p>
                        </div>
                    </div>
                    </div>";
            }
            ?>
            <?php
                $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM info"));
                $jmlhalaman  = $p1->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p1->navHalaman($_GET['hal'], $jmlhalaman);
                if ($jmldata>=14){
                    echo "<div class='pagination pagination-centered'><ul>$linkHalaman</ul></div>";
                }
            ?>
        </div>
    </div>
</div>