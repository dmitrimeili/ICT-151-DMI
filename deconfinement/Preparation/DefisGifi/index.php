<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "model/database.php";

// Lire les données dont la vue aura besoin pour créer le formulaire
$students = selectMany("Select * from person where role=0", []);
$evals = selectMany("Select idEvaluation,testDescription, moduleShortName from evaluation 
	inner join moduleinstance on fkModuleInstance = idModuleInstance 
    inner join module on fkModule = idModule", []);
$profs = selectMany("select * from person where role=1", []);

?>

<div>
    <p>Note ajoutée: <?= var_dump($newGrade) ?></p>
</div>
<div>
    <form method="post" action="view/addGrade.php">
        Evaluation: <select name="idEval">
            <?php foreach ($evals as $eval) { ?>
                <option value="<?= $eval['idEvaluation'] ?>"><?= $eval['testDescription'] ?>,
                    module <?= $eval['moduleShortName'] ?></option>
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
    </form>
</div>
<div>
    <p>Tous les profs</p>
    <select name="Prof">
        <?php foreach ($profs as $prof) { ?>
            <option value="<?= $prof['idPerson'] ?>"><?= $prof['personFirstName'] ?><?= $prof['personLastName'] ?></option>
        <?php } ?>
    </select>
</div>
<div>
    <p>Mauvaise Notes</p>
    <form method="post" action="view/badGrade.php">
        Elève: <select name="idStudent">
            <?php foreach ($students as $student) { ?>
                <option value="<?= $student['idPerson'] ?>"><?= $student['personFirstName'] ?> <?= $student['personLastName'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="show" value="Ok">
    </form>
</div>
<div>
    <p>Notes par rapport a un prof</p>
    <form method="post" action="view/teachersGrade.php">
        Elève: <select name="idStudent">
            <?php foreach ($students as $student) { ?>
                <option value="<?= $student['idPerson'] ?>"><?= $student['personFirstName'] ?> <?= $student['personLastName'] ?></option>
            <?php } ?>
        </select>
        Profs:<select name="idProf">
            <?php foreach ($profs as $prof) { ?>
                <option value="<?= $prof['idPerson'] ?>"><?= $prof['personFirstName'] ?><?= $prof['personLastName'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="teacherGrade" value="Ok">
    </form>
</div>


