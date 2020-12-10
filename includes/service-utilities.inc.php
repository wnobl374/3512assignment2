<?php

function getJsonErrorMessage()
{
    return '{"error": {"message":"Value not found or Incorrect query string values"}}';
}

/*
  Checks if valid query string information was passed in GET or POST
*/
function isCorrectQueryStringInfo($paramName) {
  if (isIdPresent($paramName)) {
    return true;
  }
  return false;
}

/*
  Checks for query string info that specifies which criteria to use
*/
function isIdPresent($paramName) {
    $lower = strtolower($paramName);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$lower]) && !empty($_GET[$lower])) {
        return true;
    }
    
    return false;
}
