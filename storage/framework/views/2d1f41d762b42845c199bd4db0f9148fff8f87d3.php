
<!-- START DATA -->
<?php $__env->startSection('konten'); ?>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <form class="d-flex" action="<?php echo e(url('mahasiswa')); ?>" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="<?php echo e(Request::get('katakunci')); ?>"
                    placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>

        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='<?php echo e(url('mahasiswa/create')); ?>' class="btn btn-primary">+ Tambah Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">NIM</th>
                    <th class="col-md-2">Nama</th>
                    <th class="col-md-1">Jenis Kelamin</th>
                    <th class="col-md-3">Prodi</th>
                    <th class="col-md-4">Alamat</th>
                    <th class="col-md-4">Email</th>
                    <th class="col-md-3">Foto</th>
                    <th class="col-md-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem(); ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i); ?></td>
                        <td><?php echo e($item->nim); ?></td>
                        <td><?php echo e($item->nama); ?></td>
                        <td><?php echo e($item->jenis_kelamin); ?></td>
                        <td> <?php echo e($item->jurusan); ?></td>
                        <td><?php echo e($item->alamat); ?></td>
                        <td><?php echo e($item->email); ?></td>
                        <td>
                            <?php if($item->foto): ?>
                                <img style="max-height: 50px; max-height:50px "
                                    src="<?php echo e(url('foto') . '/' . $item->foto); ?>" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href='<?php echo e(url('mahasiswa/' . $item->nim . '/edit')); ?>'
                                class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Yakin akan menghapus data ? ')" class='d-inline'
                                action="<?php echo e(url('mahasiswa/' . $item->nim)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
        <?php echo e($data->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\study-web\crud-larravel\resources\views/mahasiswa/index.blade.php ENDPATH**/ ?>