<?php $this->extend('Monitoring/layout'); ?>
<?php $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row my-4">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Capacity System</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Data Produksi
                                </h5>
                            </div>

                        </div>
                        <div>
                            <button type="button" class="btn btn-success btn-sm import-btn" data-toggle="modal" data-target="#EditModal" data-id="">
                                Input Produksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display compact " style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    Tanggal Produksi
                                </th>
                                <th>
                                    No Model
                                </th>
                                <th>Area </th>
                                <th>Inisial </th>
                                <th>Syle Size</th>
                                <th>Qty produksi</th>
                                <th>Bs produksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produksi as $pr) : ?>
                                <tr>

                                    <td class="text-sm"><?= $pr['date_production']; ?></td>
                                    <td class="text-sm"><?= $pr['no_model']; ?></td>
                                    <td class="text-sm"><?= $pr['area']; ?></td>
                                    <td class="text-sm"><?= $pr['inisial']; ?> Unit</td>
                                    <td class="text-sm"><?= $pr['style_size']; ?></td>
                                    <td class="text-sm"><?= $pr['qty_production']; ?></td>
                                    <td class="text-sm"><?= $pr['bs_mc']; ?></td>
                                    <td class="text-sm">
                                        <button type="button" class="btn btn-info btn-sm edit-btn" id="edit-btn" data-qty="<?= $pr['qty_production']; ?>" data-bs="<?= $pr['bs_mc']; ?>" data-id="<?= $pr['id_production']; ?>" data-toggle="modal">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" id="delete-btn" data-id="<?= $pr['id_production']; ?>">
                                            Delete
                                        </button>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= session()->getFlashdata('success') ?>',
                });
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?= session()->getFlashdata('error') ?>',
                });
            });
        </script>
    <?php endif; ?>

    <!-- modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Produksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body align-items-center">

                    <div class="row mt-2">
                        <div class="col-12 pl-0">

                            <form action="<?= base_url('area/inputproduksi') ?>" id="modalForm" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">No Model:</label>
                                    <input type="text" name="no_model" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Inisial:</label>
                                    <input type="text" name="inisial" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Qty Produksi:</label>
                                    <input type="number" name="qty" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Bs Produksi:</label>
                                    <input type="number" name="bs" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Tanggal Produksi:</label>
                                    <input type="date" name="date" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Run Mesin:</label>
                                    <input type="number" name="runmc" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <button type="submit" class="btn btn-info btn-block w-100"> Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- modal edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Produksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body align-items-center">

                    <div class="row mt-2">
                        <div class="col-12 pl-0">
                            <form action="<?= base_url('area/inputproduksi') ?>" id="modalForm" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Qty Produksi:</label>
                                    <input type="number" name="qty" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Bs Produksi:</label>
                                    <input type="number" name="bs" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>



                                <button type="submit" class="btn btn-info btn-block w-100"> Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- modal delete -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDelete" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data Produksi</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body align-items-center">

                    <div class="row mt-2">
                        <div class="col-12 pl-0">
                            <form action="<?= base_url('area/inputproduksi') ?>" id="modalForm" method="POST" enctype="multipart/form-data">

                                Anda yakin ingin menghapus data?

                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-danger btn-block w-100"> Hapus</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Trigger import modal when import button is clicked
            $('.import-btn').click(function() {

                $('#importModal').modal('show'); // Show the modal
            });
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                $('#ModalDelete').find('form').attr('action', '<?= base_url('monitoring/deleteproduksi/') ?>' + id);

                $('#ModalDelete').modal('show'); // Show the modal
            });

            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var qty = $(this).data('qty');
                var bs = $(this).data('bs');

                $('#ModalEdit').find('form').attr('action', '<?= base_url('monitoring/editproduksi/') ?>' + id);
                $('#ModalEdit').find('input[name="qty"]').val(qty);
                $('#ModalEdit').find('input[name="bs"]').val(bs);
                $('#ModalEdit').modal('show'); // Show the modal
            });

            $('#example').DataTable({
                "order": []
            });
        });
    </script>
    <?php $this->endSection(); ?>