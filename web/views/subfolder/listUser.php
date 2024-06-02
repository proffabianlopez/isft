<?php $dataUser=UserController::getAllUser();?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover">
                <thead class="bg-yellow text-white"> 
                    <tr>            
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php foreach ($dataUser as $user): ?>
                        <tr class="<?php echo ($user['state'] == 1) ? 'bg-white' : 'bg-light'; ?>">
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['state'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageUser')): ?>
                            <td>
                            <a href="index.php?pages=manageUser&subfolder=eliminatedUser&id_user=<?php echo $user['id_user']?>" class="btn btn-danger delete-user">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php if ($user['state'] == 1): ?>
                                <a href="index.php?pages=manageUser&action=deshabilitar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-primary" title="Deshabilitar cuenta"><i class="fas fa-toggle-on"></i></a>
                                <?php else: ?>
                                <a href="index.php?pages=manageUser&action=habilitar_cuenta&id_user=<?php echo $user['id_user']?>" class="btn btn-danger" title="Habilitar cuenta"><i class="fas fa-toggle-off"></i></a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
        </div>
    </div>
</div>
<?php if(isset($_GET['action'])){
    if($_GET['action']=="deshabilitar_cuenta"){
      $controller=new UserController();
      $controller->disableAccountUser();
    }else{
        $controller=new UserController();
        $controller->enableAccountUser();
    }
}?>
