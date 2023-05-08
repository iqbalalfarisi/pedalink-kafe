<?php
error_reporting(0);
?>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>


<div class="col-md-12">
    <div class="box box-info">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-primary large fa fa-print" onclick="printContent('cetak_report')"> Cetak</button>
            </div>
            <div class="well well-sm noprint">
                <form class="form-inline" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="sr-only" for="tgl1">Awal</label>
                        <input type="date" class="form-control" id="tgl1" name="tgl1" required>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="tgl2">Akhir</label>
                        <input type="date" class="form-control" id="tgl2" name="tgl2" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
                </form>
            </div>
            <div class="modal-body" id="cetak_report">
                <style type="text/css">
                    #customers {
                        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                    }

                    #customers td,
                    #customers th {
                        border: 1px solid #ddd;
                        padding: 8px;
                    }

                    #customers tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    #customers tr:hover {
                        background-color: #ddd;
                    }

                    #customers th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #4CAF50;
                        color: white;
                    }
                </style>
                </style>
                <center>
                    <H3> LAPORAN RESERVASI </H3>
                </center>

                <table id="customers" width="100%" border="1">
                    <tr>
                        <th>NO</th>
                        <th>TANGGAL</th>
                        <th>NAMA PELANGGAN</th>
                        <th>NO HP</th>
                        <th>PUKUL</th>
                        <th>KAPASITAS</th>
                        <th>TOTAL</th>
                        <th>UANG MUKA</th>
                        <th> STATUS</th>
                    </tr>
                    <?php
                    $no = 1;
                    if (isset($_REQUEST['submit'])) {
                        $submit = $_REQUEST['submit'];
                        $tgl1 = $_REQUEST['tgl1'];
                        $tgl2 = $_REQUEST['tgl2'];
                        $select = mysqli_query($konek, "SELECT * from header_reservasi WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'");
                    } else {
                        $select = mysqli_query($konek, "SELECT * from header_reservasi");
                    }

                    if (mysqli_num_rows($select)) {
                        while ($data = mysqli_fetch_array($select)) {
                            ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['nama_pelanggan']; ?></td>
                        <td><?php echo $data['no_hp']; ?></td>
                        <td><?php echo $data['pukul']; ?></td>
                        <td><?php echo $data['kapasitas']; ?></td>
                        <td>Rp. <?php echo (number_format($data['total'])); ?></td>
                        <td>Rp. <?php echo (number_format($data['dp'])); ?></td>
                        <td><?php echo $data['status']; ?></td>
                    </tr>

                    <?php }
                    } else {
                        echo "Tidak di temukan";
                    }
                    ?>
                </table>

                <!-- <small><?php echo $tgl1; ?> & <?php echo $tgl2; ?> </small></h2><hr> -->



                <p align="right">
                    <td></td>
                    <td>Diketahui Oleh <br> Pemilik
                        <br><br><br><br>

                        ________________________
                    </td>


                </p>
            </div>

        </div>

    </div>
    <!-- </div> -->
</div>
</div>