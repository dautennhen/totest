<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ZipCodeRepository as ZipCodeRepository;

class AclRepositoryTest extends TestCase
{   
    public function testModel()
    {
        $zipcode = \App\Models\Zipcode::first();//$zipcode->first();
        //var_dump($zipcode);//$zipcode->zipcode;
        $this->assertEquals($zipcode->zipcode, 218);
    }
    
    public function testRepository()
    {
        $repo = new ZipCodeRepository;
        $repo = $repo->getFirst();
        $this->assertEquals($repo->zipcode, 218);
    }
}
