<?php
require 'database.php';

function getEvaluations(){
    return selectMany('select testDescription from evaluation');
}