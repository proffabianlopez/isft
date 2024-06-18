<?php 
if( (isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state'])) ) {    
    $data = CareerModel::careerInfo($_GET['id_career']);
    $dataPreceptor=CareerModel::carrerInfoPreceptor($_GET['id_career']);
    $dataCountStudent=CareerModel::careerCountStudent($_GET['id_career']);
?>
<section class="container py-3">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="text-center mt-1 mb-3 lead">Datos de Carrera</h2>
            <img src="public/img/isft177_H.png" class="card-img-top img-fluid mx-auto d-block" alt="logo ISFT Nº 177">
            <h5 class="card-title text-center py-2"><strong>Nombre: </strong><?php echo htmlspecialchars($data['name_career']); ?></h5>
            <p class="card-text text-center"><strong>Título: </strong><?php echo htmlspecialchars($data['title']); ?></p>
            <p class="card-text text-center"><strong>Abreviatura: </strong><?php echo htmlspecialchars($data['abbreviation']); ?></p>
            <hr>
            <div class="text-center">
                <?php foreach($dataPreceptor as $preceptor): ?>
                    <p class="card-text"><strong>Preceptor: </strong><?php echo htmlspecialchars($preceptor['preceptores']); ?></p>
                <?php endforeach; ?>
                <p class="card-text"><strong>Cantidad de alumnos Inscriptos </strong><?php echo htmlspecialchars($dataCountStudent['total_student']); ?></p>   
                <p class="card-text"><strong>Cantidad de Materias: </strong><?php echo htmlspecialchars($data['total_subject']); ?></p>
                <p class="card-text"><strong>Carga Horaria Total: </strong><?php echo htmlspecialchars($data['total_hours']); ?>hrs</p>
            </div>
            <hr>
            <div class="text-center">
                <a href="index.php?pages=toolsCareer&id_career=<?php echo $_GET['id_career']; ?>&name_career=<?php echo $_GET['name_career']; ?>&state=<?php echo $_GET['state']; ?>" class="btn btn-secondary mx-2">Volver</a>
                <form method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger mx-2" name="pdf_career">
                    <i class="fas fa-file-pdf"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
}
// if (isset($_POST['pdf'])) {
//     (new PdfController()) ->pdfDataCareer();
// }