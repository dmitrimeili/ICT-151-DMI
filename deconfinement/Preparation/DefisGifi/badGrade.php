<?php
require_once "model/database.php";
if (isset($_POST["show"])) {
    $student=$_POST["idStudent"];
    $note = selectMany("SELECT * FROM app_pfinfo.person  inner join app_pfinfo.grade on person.idPerson=grade.fkStudent where gradeValue <4 and idPerson = :student",["student"=>$student]);
}
var_dump($note);
?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$note["personLastName"]?></td>
        <td><?=$note["personFirstName"]?></td>
        <td><?=$note["gradeValue"]?></td>
    </tr>
    </tbody>

</table>
