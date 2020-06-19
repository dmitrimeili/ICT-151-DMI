<?php
require_once "model/database.php";
if (isset($_POST["show"])) {
    $student=$_POST["idStudent"];
    $notes = selectMany("SELECT * FROM app_pfinfo.person  inner join app_pfinfo.grade on person.idPerson=grade.fkStudent where gradeValue <4 and idPerson = :student",["student"=>$student]);
}

?>
<html>

<body>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($notes as $note){ ?>
        <tr>
            <td><?=$note["personLastName"]?></td>
            <td><?=$note["personFirstName"]?></td>
            <td><?=$note["gradeValue"]?></td>
        </tr>
    <?php } ?>
    </tbody>

</table>
</body>
</html>