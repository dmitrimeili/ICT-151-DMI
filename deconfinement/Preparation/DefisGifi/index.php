<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "model/database.php";
if (isset($_POST["store"])) {
    extract($_POST); // idEval, idStudent, $gradeValue
    $newGrade = insert("Insert into grade (gradeValue,fkStudent,fkEval) values (:grade,:student,:eval)",
        [
            "grade" => $gradeValue,
            "student" => $idStudent,
            "eval" => $idEval
        ]);
}

// Lire les données dont la vue aura besoin pour créer le formulaire
$students = selectMany("Select * from person where role=0", []);
$evals = selectMany("Select testDescription, moduleShortName from evaluation 
	inner join moduleinstance on fkModuleInstance = idModuleInstance 
    inner join module on fkModule = idModule", []);
?>

<div>
    <p>Note ajoutée: <?=var_dump($newGrade)?></p>
</div>
<div>
    <form method="post">
        Evaluation: <select name="idEval">
            <?php foreach ($evals as $eval) { ?>
                <option value="<?= $eval['idEvaluation'] ?>"><?= $eval['testDescription'] ?>, module <?= $eval['moduleShortName'] ?></option>
            <?php } ?>
        </select>
        <br>
        Elève: <select name="idStudent">
            <?php foreach ($students as $student) { ?>
                <option value="<?= $student['idPerson'] ?>"><?= $student['personFirstName'] ?> <?= $student['personLastName'] ?></option>
            <?php } ?>
        </select>
        <br>
        Note: <input type="text" name="gradeValue">
        <br>
        <input type="submit" name="store" value="Ok">

        <h1>Résultat</h1>
        <?php if ($newGrade > 0) { // La note a pu être créée puisqu'on a reçu un id en retour ?>
            <div>
                <p>La note ajoutée a l'id: <?= $newGrade ?></p>
            </div>
        <?php } else { ?>
            <div>
                <p>Un problème est survenu</p>
            </div>
        <?php } ?>
        <a href="/">Retour</a>
    </form>
</div>

