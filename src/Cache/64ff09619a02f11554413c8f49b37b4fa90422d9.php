<form id="editUser" action="<?php echo e(siteUrl('/forms/users/edit')); ?>" method="POST">
    <input type="hidden" name="modal-edit-user-id" value="<?php echo e($user_edit->id); ?>"">
    <div class=" modal-header">
    <h5 class="modal-title mt-0">Editar usuario</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body" id="modal-edit-user-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-name">Nombre</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?php echo e($user_edit->name); ?>" id="modal-edit-user-name" name="modal-edit-user-name" placeholder="Nombre del usuario" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-email">Email</label>
            <div class="col-sm-10">
                <input class="form-control" type="email" value="<?php echo e($user_edit->email); ?>" id="modal-edit-user-email" name="modal-edit-user-email" placeholder="nombre@ejemplo.com" parsley-type="email" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-role">Contraseña</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" value="" id="modal-edit-user-pass" name="modal-edit-user-pass" placeholder="Ingrese contraseña nueva si desea cambiarla">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-role">Repetir contraseña</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" value="" id="modal-edit-user-repeat-pass" placeholder="Repetir contraseña" data-parsley-equalto="#modal-edit-user-pass">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-role">Reenviar mail</label>
            <div class="col-sm-10">
                <input id="resend-switch" type="checkbox" class="iswitch iswitch-primary pull-left" name="resend-data">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="modal-edit-user-role">Rol</label>
            <div class="col-sm-10">
                <select id="modal-edit-user-role" name="modal-edit-user-role" class="form-control select2" required>
                    <option value="1" <?php if($user_edit->role==1): ?> selected <?php endif; ?>>Administrador</option>
                </select>
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
    $('#resend-switch').change(function() {
        $("#modal-edit-user-pass").prop('required',this.checked);
        $("#modal-edit-user-repeat-pass").prop('required',this.checked);
        // $("#editUser").parsley();
    });
</script><?php /**PATH /Users/nicolasmolina/Sites/salliquelo-recibos/src/Views/admin/components/modals/edit-user.blade.php ENDPATH**/ ?>