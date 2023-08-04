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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['ID_GAJI']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                            <label for="ID_GAJI">Id Gaji</label>
                            <input type="text" name="ID_GAJI" id="ID_GAJI" value="<?php echo empty(set_value('ID_GAJI')) ? (empty($edit_data['ID_GAJI']) ?"":$edit_data['ID_GAJI']) : set_value('ID_GAJI'); ?>" class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="GAJI_POKOK">Gaji Pokok</label>
                            <input type="text" name="GAJI_POKOK" id="GAJI_POKOK" value="<?php echo empty(set_value('GAJI_POKOK')) ? (empty($edit_data['GAJI_POKOK']) ? "":$edit_data['GAJI_POKOK']) : set_value('GAJI_POKOK') ; ?>"class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="TUNJANGAN">Gaji Tunjangan</label>
                            <input type="text" name="TUNJANGAN" id="TUNJANGAN" value="<?php echo empty(set_value('TUNJANGAN')) ? (empty($edit_data['TUNJANGAN']) ? "":$edit_data['TUNJANGAN']) : set_value('TUNJANGAN') ; ?>"class ="form-control">
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
