<?php $this->extend('Monitoring/layout'); ?>
<?php $this->section('content'); ?>
<div class="container-fluid py-4">
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



    <div class="row mt-4">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-2">
            <div class="card">
                <div class="card-header">
                    <h5>
                        Data order
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display">
                            <thead>

                                <th>
                                    No Model
                                </th>
                                <th>Buyer </th>
                                <th>Inisial </th>
                                <th>Syle Size</th>
                                <th>Sisa Order</th>
                                <th>Jarum</th>
                                <th>Acion</th>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $order) : ?>
                                    <tr>
                                        <td><?= $order['no_model'] ?></td>
                                        <td><?= $order['buyer'] ?></td>
                                        <td><?= $order['inisial'] ?></td>
                                        <td><?= $order['style_size'] ?></td>
                                        <td><?= $order['qty_po'] ?> Pcs</td>
                                        <td><?= $order['jarum'] ?> </td>
                                        <td class="text-sm">
                                            <button type="button" class="btn btn-info btn-sm edit-btn" id="edit-btn" data-inisial="<?= $order['inisial']; ?>" data-style="<?= $order['style_size']; ?>" data-id="<?= $order['id_inisial']; ?>" data-toggle="modal" data-qty="<?= $order['qty_po']; ?>" data-jarum="<?= $order['jarum']; ?>">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger delete-btn" id="delete-btn" data-id="<?= $order['id_inisial']; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
                                    <label for="seam" class="col-form-label">Inisial:</label>
                                    <input type="text" name="inisial" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">style:</label>
                                    <input type="text" name="style" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Sisa Order:</label>
                                    <input type="number" name="qty" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="form-group">
                                    <label for="seam" class="col-form-label">Jarum:</label>
                                    <input type="number" name="jarum" id="" class="form-control" oninput="this.value = this.value.toUpperCase()">
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
</div>
<script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTable1').DataTable();
    });
    $(document).ready(function() {
        $('#example').DataTable({});

        // Trigger import modal when import button is clicked
        $('.import-btn').click(function() {
            console.log("a");
            var idModel = $(this).data('id');
            var noModel = $(this).data('no-model');

            $('#importModal').find('input[name="id_model"]').val(idModel);
            $('#importModal').find('input[name="no_model"]').val(noModel);

            $('#importModal').modal('show'); // Show the modal
        });
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            $('#ModalDelete').find('form').attr('action', '<?= base_url('monitoring/deleteproduksi/') ?>' + id);

            $('#ModalDelete').modal('show'); // Show the modal
        });

        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var jarum = $(this).data('jarum');
            var qty = $(this).data('qty');
            var style = $(this).data('style');
            var inisial = $(this).data('inisial');

            $('#ModalEdit').find('form').attr('action', '<?= base_url('monitoring/editorder/') ?>' + id);
            $('#ModalEdit').find('input[name="qty"]').val(qty);
            $('#ModalEdit').find('input[name="style"]').val(style);
            $('#ModalEdit').find('input[name="jarum"]').val(jarum);
            $('#ModalEdit').find('input[name="inisial"]').val(inisial);
            $('#ModalEdit').modal('show'); // Show the modal
        });
    });
</script>
<!-- <script>
    let data =;
    console.log(data)
    // Ekstraksi tanggal dan jumlah produksi dari data
    let labels = data.map(item => item.created_at);
    let values = data.map(item => item.total_produksi);


    var ctx2 = document.getElementById("mixed-chart").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {

        data: {
            labels: labels,
            datasets: [{
                    type: "bar",
                    label: "Data Turun Order",
                    borderWidth: 0,
                    pointRadius: 30,

                    backgroundColor: "#3A416F",
                    fill: true,
                    data: values,
                    maxBarThickness: 20

                },
                {
                    type: "line",

                    tension: 0.1,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 2,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: values,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script> -->
<?php $this->endSection(); ?>