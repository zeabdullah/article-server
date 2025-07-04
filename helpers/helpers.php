<?php

/**
 * Returns a tuple of 2 strings of comma-separated values:
 * 1. keys of `$dataAssoc` array
 * 2. a string of adjacent placeholder `?` symbols, for `INSERT` SQL statement params
 * @param array $dataAssoc
 * @return string[] `[string, string]` tuple
 */
function getJoinedSqlINSERTStrings(array $dataAssoc): array
{
    $joinedCols = implode(',', array_keys($dataAssoc));
    $joinedValuePlaceholders = implode(',', array_fill(0, count($dataAssoc), '?'));

    return [$joinedCols, $joinedValuePlaceholders];
}

function getRequestBodyAsJson()
{
    return json_decode(file_get_contents('php://input'));
}