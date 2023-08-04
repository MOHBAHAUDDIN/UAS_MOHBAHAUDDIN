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
                        <input type="hidden" name="param" id="param" value="<?php echo $edit_data['ID_BAGIAN']; ?>">
                        <?php
                    }
                    ?>
                    <div class="form-group">
                            <label for="ID_BAGIAN">Id Bagian</label>
                            <input type="text" name="ID_BAGIAN" id="ID_BAGIAN" value="<?php echo empty(set_value('ID_BAGIAN')) ? (empty($edit_data['ID_BAGIAN']) ?"":$edit_data['ID_BAGIAN']) : set_value('ID_BAGIAN'); ?>" class ="form-control">
                    </div>
                    <div class="form-group">
                            <label for="NAMA_BAGIAN">Nama Bagian</label>
                            <input type="text" name="NAMA_BAGIAN" id="NAMA_BAGIAN" value="<?php echo empty(set_value('NAMA_BAGIAN')) ? (empty($edit_data['NAMA_BAGIAN']) ? "":$edit_data['NAMA_BAGIAN']) : set_value('NAMA_BAGIAN') ; ?>"class ="form-control">
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
