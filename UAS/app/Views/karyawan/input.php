<?php
echo $this->extend('template/index');
echo $this->section('content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>
            <!-- /.card-header -->

            <form action="<?php echo $action; ?>" method="post">
                <div class="card-body">
                    <?php if(validation_errors()) {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if(session()->getFlashdata('error')) {
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-warning"></i> Error</h5>
                                <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php echo csrf_field() ?>
                    <?php
                    if(current_url(true)->getSegment(2) =='edit'){
                        ?>
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['ID_KARYAWAN']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                            <label for="ID_KARYAWAN">Id Karyawan</label>
                            <input type="text" name="ID_KARYAWAN" id="ID_KARYAWAN" value="<?php echo empty(set_value('ID_KARYAWAN')) ? (empty($edit_data['ID_KARYAWAN']) ?"":$edit_data['ID_KARYAWAN']) : set_value('ID_KARYAWAN'); ?>" class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="NAMA">Nama</label>
                            <input type="text" name="NAMA" id="NAMA" value="<?php echo empty(set_value('NAMA')) ? (empty($edit_data['NAMA']) ? "":$edit_data['NAMA']) : set_value('NAMA') ; ?>"class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="JENIS_KELAMIN">Jenis Kelamin</label>
                            <input type="text" name="JENIS_KELAMIN" id="JENIS_KELAMIN" value="<?php echo empty(set_value('JENIS_KELAMIN')) ? (empty($edit_data['JENIS_KELAMIN']) ? "":$edit_data['JENIS_KELAMIN']) : set_value('JENIS_KELAMIN') ; ?>"class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="TELEPON">No. Telephone</label>
                            <input type="text" name="TELEPON" id="TELEPON" value="<?php echo empty(set_value('TELEPON')) ? (empty($edit_data['TELEPON']) ? "":$edit_data['TELEPON']) : set_value('TELEPON') ; ?>"class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="ALAMAT">Alamat</label>
                            <input type="text" name="ALAMAT" id="ALAMAT" value="<?php echo empty(set_value('ALAMAT')) ? (empty($edit_data['ALAMAT']) ? "":$edit_data['ALAMAT']) : set_value('ALAMAT') ; ?>" class ="form-control">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
echo $this->endSection();
