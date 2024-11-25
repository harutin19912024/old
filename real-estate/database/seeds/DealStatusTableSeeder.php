<?php

use App\DealStatus;
use Illuminate\Database\Seeder;

class DealStatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('deal_statuses')->delete();

        $statuses = array(
            array(
                'id' => '1',
                'name' => 'Offer In Progress'
            ),
            array(
                'id' => '2',
                'name' => 'Offer Accepted'
            ),
            array(
                'id' => '3',
                'name' => 'Offer Declined'
            ),
            array(
                'id' => '4',
                'name' => 'Inspected'
            ),
            array(
                'id' => '5',
                'name' => 'Pending PnS'
            ),
            array(
                'id' => '6',
                'name' => 'PnS Signed'
            ),
            array(
                'id' => '7',
                'name' => 'Pending Mortgage Contingency'
            ),
            array(
                'id' => '8',
                'name' => 'Mortgage Contingency Received'
            ),
            array(
                'id' => '9',
                'name' => 'Mortgage Contingency Declined'
            ),
            array(
                'id' => '10',
                'name' => 'Pending Closing'
            ),
            array(
                'id' => '11',
                'name' => 'Closed'
            ),
            array(
                'id' => '12',
                'name' => 'Failed'
            )
        );
        
        DealStatus::insert($statuses);
    }


}
