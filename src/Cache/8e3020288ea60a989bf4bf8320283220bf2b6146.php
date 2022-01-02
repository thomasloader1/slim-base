<?php
$menuSection = 'dashboard';
$subMenuSection = 'dashboard.home';
?>



<?php $__env->startSection('admin.main'); ?>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Bienvenido</h1>
            
            <div class="separator mb-5"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\src\Views/admin/dashboard.blade.php ENDPATH**/ ?>