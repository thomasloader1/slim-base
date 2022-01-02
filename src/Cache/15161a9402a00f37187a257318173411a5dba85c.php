<form id="editUser" action="<?php echo e(siteUrl('/forms/employee/edit')); ?>" method="POST">
    <input type="hidden" name="modal-edit-user-id" value="<?php echo e($user_edit->id); ?>"">
    <div class=" modal-header">
    <h5 class="modal-title mt-0">Editar agente</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body" id="modal-edit-user-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-name" >Nombre</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo e($user_edit->name); ?>" id="modal-edit-user-name" name="modal-edit-user-name" placeholder="Nombre" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-last-name" >Apellido</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo e($user_edit->apellido); ?>" id="modal-edit-user-last-name" name="modal-edit-user-last-name" placeholder="Apellido" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-dni" >DNI</label>
            <div class="col-sm-10">
                <input class="form-control" type="number" value="<?php echo e($user_edit->dni); ?>" id="modal-edit-user-dni" name="modal-edit-user-dni" placeholder="DNI" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-legajo" >Legajo</label>
            <div class="col-sm-10">
                <input class="form-control" type="number" value="<?php echo e($user_edit->legajo); ?>" id="modal-edit-user-legajo" name="modal-edit-user-legajo" placeholder="Número de legajo" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-role" >Contraseña</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo e($user_edit->contrasenia); ?>" id="modal-edit-user-pass" name="modal-edit-user-pass" placeholder="Contraseña" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>
    </div>
</form>
<script>
    
    $('form#editUser').on("submit", function(e) {
        return $(this).parsley().validate();
    });
</script><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/admin/components/modals/edit-employee.blade.php ENDPATH**/ ?>