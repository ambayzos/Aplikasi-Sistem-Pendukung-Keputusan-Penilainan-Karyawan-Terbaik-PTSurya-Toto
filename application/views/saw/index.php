<div class="page-header">
    <h2>Halaman Hitung Rangking </h2>
    <a class="btn btn-primary" href="<?php echo base_url('cetak') ?>" target="_blank" role="button">Cetak Tabel</a>
    <a class="btn btn-primary" href="<?php echo base_url('cetak_rangking') ?>" target="_blank" role="button">Cetak Rangking</a>
</div>


<div class="col-lg-12">

    <div class="row">
        <div class="panel panel-primary" >

            <div class="panel-heading">Table Perhitungan</div>
            <div class="panel-body">
                <h2>Table 1 - Nilai Awal</h2>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="tabel">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php
                                $no = 1;
                                $table = $this->page->getData('table1');
                                foreach ($table as $item => $value) {
                                    foreach ($value as $heading => $itemValue) {
                                        ?>
                                        <th  class="text-center"><?php echo $heading ?></th>
                                        <?php
                                    }
                                    break;
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($table as $item => $value) {
                                ?>
                                <tr>
                                    <td  class="text-center"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                        ?>
                                        <td class="text-center"><?php echo $itemValue ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>

                <h2>Table 2 - Dihitung sesuai sifat cost atau benefit</h2>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="tabeldua">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php
                                $no = 1;
                                $table = $this->page->getData('table2');
                                foreach ($table as $item => $value) {
                                    foreach ($value as $heading => $itemValue) {
                                        ?>
                                        <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                    }
                                    break;
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($table as $item => $value) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                        ?>
                                        <td class="text-center"><?php echo $itemValue ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-bordered" id="tabeltiga">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Sifat</th>
                                <th class="text-center">Nilai min /max</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dataSifat = $this->page->getData('dataSifat');
                            $no = 1;
                            foreach ($dataSifat as $item => $value) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td class="text-center"><?php echo $item ?></td>
                                    <td class="text-center"><?php echo $value->sifat ?></td>
                                    <td class="text-center">
                                        <?php
                                        $valueMinMax = $dataSifat = $this->page->getData('valueMinMax');
                                        if (isset($valueMinMax['min' . $item])) {
                                            echo $valueMinMax['min' . $item] . ' - Minimal';
                                        }
                                        if (isset($valueMinMax['max' . $item])) {
                                            echo $valueMinMax['max' . $item] . ' - Maksimal';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <h2>Table 3 - Dikali dengan bobot</h2>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-bordered table-hover" id="tabelempat">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php
                                $no = 1;
                                $table = $this->page->getData('table3');
                                foreach ($table as $item => $value) {
                                    foreach ($value as $heading => $itemValue) {
                                        ?>
                                        <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                    }
                                    break;
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($table as $item => $value) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                        ?>
                                        <td><?php echo $itemValue ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-bordered" id="tabellima">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $bobot = $this->page->getData('bobot');
                            $no = 1;
                            foreach ($bobot as $item => $value) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td class="text-center"><?php echo $value->kriteria ?></td>
                                    <td class="text-center"><?php echo $value->bobot ?></td>

                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h2>Table 4 - Dijumlah sesuai dengan Karyawan dan di dapat hasil rangking</h2>
                <div class="table-responsive" style="font-size: 14px;">
                    <table width="100%" class="table table-bordered table-hover" id="tabelenam">
                        <thead>
                            <tr class="active">
                                <th class="col-md-1 text-center">No</th>
                                <?php
                                $no = 1;
                                $table = $this->page->getData('tableFinal');
                                foreach ($table as $item => $value) {
                                    foreach ($value as $heading => $itemValue) {
                                        ?>
                                        <th class="text-center"><?php echo $heading ?></th>
                                        <?php
                                    }
                                    break;
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($table as $item => $value) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <?php
                                    foreach ($value as $itemValue) {
                                        ?>
                                        <td class="text-center"><?php echo $itemValue ?></td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                $table = $this->page->getData('tableFinal');
                foreach ($table as $item => $value) {
                    if ($value->Rangking == 1) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <h4><b>Kesimpulan : </b> Dari hasil perhitungan yang dilakukan menggunakan metode SAW
                                Penilaian Karyawan Terbaik  adalah
                                <?php echo $value->Karyawan ?> dengan nilai <?php echo $value->Total ?>
                            </h4>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>


        </div>
    </div>

</div>





