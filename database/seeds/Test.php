<?php

use Illuminate\Database\Seeder;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$i = 0;
    	while($i<=10){
        DB::table('Test')->insert([
        	'Name' => 'Users_'.$i,
        	'created_at' => new datetime()
        ]);
        $i++;
    	}	
    }
}
