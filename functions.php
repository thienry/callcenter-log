<?php

use \Fasor\Model;

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}