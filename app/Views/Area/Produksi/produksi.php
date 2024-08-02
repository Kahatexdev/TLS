<?php $this->extend('Area/layout'); ?>
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
            $(function() {
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
            $(function() {
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
                                    <select class="form-control" id="productType" name="no_model">
                                        <option value="0">Choose</option>
                                        <?php foreach ($model as $pr) : ?>
                                            <option value="<?= $pr['id_order'] ?>"><?= $pr['no_model'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Inisial:</label>
                                    <select class="form-control" id="id_inisial" name="id_inisial"></select>
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Qty Produksi:</label>
                                    <input type="number" name="qty_production" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Bs Produksi:</label>
                                    <input type="number" name="bs_mc" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Tanggal Produksi:</label>
                                    <input type="date" name="date" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Run Mesin:</label>
                                    <input type="number" name="run_mc" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>

                                <button type="submit" class="btn btn-info btn-block w-100"> Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= base_url('assets/js/dataTables.buttons.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/jszip.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/buttons.html5.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Trigger import modal when import button is clicked
            $('.import-btn').click(function() {

                $('#importModal').modal('show'); // Show the modal
            });

            new DataTable('#example', {
                layout: {
                    top1Start: {
                        buttons: [{
                            extend: 'excel',
                            text: 'Export To Excel',
                            className: 'btn btn-success btn-sm'
                        }]
                    }
                }
            });
        });

        $('#productType').change(() => {
            $.ajax({
                url: 'getInitialByModel',
                method: 'post',
                dataType: 'json',
                data: {
                    id_order: $('#productType').val()
                },
                success: (data) => {
                    $('#id_inisial').html('')
                    var html = ""
                    data.map((item) => {
                        html += `<option value="${item.id_inisial}">${item.inisial}</option>`
                    })
                    $('#id_inisial').html(html)
                }
            })
        })
    </script>
    <?php $this->endSection(); ?>