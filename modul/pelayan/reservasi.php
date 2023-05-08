  <?php
    error_reporting(0);
    ?>
  <div class="col-md-12">
      <div class="box">

          <div class="box-header">
              <h4> Daftar Pesanan Reservasi</H4>
              <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>NAMA MENU</th>

                              <th>HARGA</th>
                              <th>JUMLAH</th>
                              <th>SUB TOTAL</th>
                          </tr>
                      </thead>
                      <tbody>


                          <?php

                            $qry = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori`,`header_pesanan`.`kode_reservasi` AS `kode_reservasi`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`total` AS `total`,`header_pesanan`.`status` AS `status_master` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where ((`detail_pesanan`.`status` = '1') and (`header_pesanan`.`status` <> 'Batal Reservasi'))");
                            while ($data = mysqli_fetch_array($qry)) {
                                $jumlah = $data['jumlah'];
                                $harga = $data['harga'];
                                $hasil = $harga * $jumlah;



                                ?>
                          <tr>

                              <td><?php echo $data['nama']; ?></td>

                              <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
                              <td><?php echo $data['jumlah']; ?></td>
                              <td>Rp. <?php echo (number_format($hasil)); ?></td>
                          </tr>
                          <?php } ?>

                          </tfoot>
                  </table>
              </div>
          </div>
      </div>
  </div>


  </div>