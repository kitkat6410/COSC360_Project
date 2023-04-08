<?php

class unitTest extends \PHPUnit\Framework\TestCase{
    public function testLogin(){
        //test to generate accurate query for logging in
        $query1 = new Query\query();
        $par1 = "userinfo";
        $par2 = ":username";
        
        $result = $query1->genQuery($par1, $par2);
        
        $this->assertEquals("SELECT * FROM userinfo WHERE Username = :username ", $result);
    }
}
?>