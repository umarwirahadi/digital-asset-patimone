<?php

namespace Database\Seeders;

use App\Models\Item;
use DB;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();
        $items = [
            ['item_code' => 'Employer','item_name' => 'Employer','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => 'Engineer','item_name' => 'Engineer','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => 'Inspector','item_name' => 'Inspector','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => 'Contractor','item_name' => 'Contractor','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => 'Subcontractor','item_name' => 'Subcontractor','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => 'Supplier','item_name' => 'Supplier','item_category' => 'Type of Employer','status' => 'Active'],
            ['item_code' => '1','item_name' => 'Requisition / Supply of Expendable Items for Engineers Site Office','item_category' => 'req. type','status' => 'Active'],
            ['item_code' => '2','item_name' => 'Requisition For Maintenance Site Office','item_category' => 'req. type','status' => 'Active'],
            ['item_code' => '3','item_name' => 'Requisition For Maintenance Air Condition','item_category' => 'req. type','status' => 'Active'],
            ['item_code' => '4','item_name' => 'Requisition For PEST Control','item_category' => 'req. type','status' => 'Active'],
            ['item_code' => 'unit','item_name' => 'unit','item_category' => 'unit','status' => 'Active'],
            ['item_code' => 'pcs','item_name' => 'PCS','item_category' => 'unit','status' => 'Active'],
            ['item_code' => 'Box','item_name' => 'Box','item_category' => 'unit','status' => 'Active'],
            ['item_code' => 'Set','item_name' => 'Set','item_category' => 'unit','status' => 'Active']
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
        $this->command->info('Items seeded successfully.');
        $this->command->info('Seeding completed.');
        $this->command->info('Total items seeded: ' . count($items));
    }
}
