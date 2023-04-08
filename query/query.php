<?php

namespace Query;
 
class query{
    
    public function genQuery($table, $placeholder): string{
        $query = "SELECT * FROM ".$table." WHERE Username = ".$placeholder." ";
        return $query;
    }
}
?>