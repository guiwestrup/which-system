<?php

class DistroTest extends TestCase
{
    /**
     *  /api/v1/distro/ [GET]
     */
    public function testShouldReturnDistro(){
        
        $this->get("/api/v1/distro/1", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            "data" => [ '*' => 
                [
                    "name",
                    "description",
                    "created_at",
                    "updated_at",
                ]
            ],
            "meta" => [
                "*" => [
                    "total",
                    "count",
                    "per_page",
                    "current_page",
                ]
            ]
        ]);
    }

    /**
     * /api/v1/distro/id [DELETE]
     */
    public function testShouldDeleteProduct(){

        $this->delete("api/v1/distro/2", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
                'status',
                'message'
        ]);
    }


}
