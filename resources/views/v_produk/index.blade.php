<div class="container-fluid">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
            <a href="#" class="btn btn-primary mb-4">Tambah Produk</a>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Harga</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Jumlah</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Foto</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $no++ ?></h6></td>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $row['name'] ?></h6></td>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $row['price'] ?></h6></td>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?= $row['amount'] ?></h6></td>
                        <td>
                            <form action="" method="post" >
                                <a href="edit_produk.php?id=<?php echo $row['id'];?>" class="btn btn-mini btn-success">
                                    Update
                                </a>
                                <button type="submit" value="<?php echo $row['id'];?>" name="hapus" class="btn btn-mini btn-danger" style="margin-left: 1rem;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>