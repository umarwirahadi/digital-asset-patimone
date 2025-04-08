<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        $positions = [
            [
                'code' => 'A-21',
                'position_name' => 'Safety Special',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B08.1',
                'position_name' => 'Electrical Engineer HV',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-09',
                'position_name' => 'Building Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-18',
                'position_name' => 'Environmental Expert (Natural)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'BXIX',
                'position_name' => 'Architect',
                'category' => 'engineer',
            ],
            [
                'code' => 'A-02',
                'position_name' => 'Project Manager 1',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-01',
                'position_name' => 'Project Director',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C07',
                'position_name' => 'CAD Operator',
                'category' => 'supporting',
            ],
            [
                'code' => 'A-17',
                'position_name' => 'Junior Coastal Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C09',
                'position_name' => 'Office Boy',
                'category' => 'supporting',
            ],
            [
                'code' => 'C12.1',
                'position_name' => 'Document Controller 1',
                'category' => 'supporting',
            ],
            [
                'code' => 'B19',
                'position_name' => 'Safety Specialist',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B06.1',
                'position_name' => 'Civil Engineer 2 (Yard PKG5)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-16',
                'position_name' => 'Senior Coastal Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C03',
                'position_name' => 'Billingual Secreatary',
                'category' => 'supporting',
            ],
            [
                'code' => 'C11.1',
                'position_name' => 'General Affair Secretary',
                'category' => 'supporting',
            ],
            [
                'code' => 'B21.2',
                'position_name' => 'Quantity Surveyor (Port)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B18',
                'position_name' => 'Environmental Expert (Social)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C04',
                'position_name' => 'Document Control',
                'category' => 'supporting',
            ],
            [
                'code' => 'A-20',
                'position_name' => 'Quality Control (Port)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-15',
                'position_name' => 'Financial Expert',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B21',
                'position_name' => 'Quantity Surveyor (Port)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-06',
                'position_name' => 'Soil Mechanic Engineer-2',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B05',
                'position_name' => 'Civil Engineer-1 (Reclamation)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C01',
                'position_name' => 'Office manager',
                'category' => 'supporting',
            ],
            [
                'code' => 'B11',
                'position_name' => 'Construction Planning Expert',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B04',
                'position_name' => 'Marine Structural Engineer-2',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-03',
                'position_name' => 'Marine Structure Engineer 1 (Contrainer Terminal)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-02.1',
                'position_name' => 'Project Manager 2',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B13',
                'position_name' => 'Survey Expert (Typo-Hydro)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B00',
                'position_name' => 'Assistant Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B17',
                'position_name' => 'Environmental Expert (Natural)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B41',
                'position_name' => 'Reporting Specialist',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C02',
                'position_name' => 'Billingual Secreatary',
                'category' => 'supporting',
            ],
            [
                'code' => 'B07.1',
                'position_name' => 'Mechanical Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C10',
                'position_name' => 'Office Boy',
                'category' => 'supporting',
            ],
            [
                'code' => 'BXI',
                'position_name' => 'Co-Local Team Leader/Building Engineer',
                'category' => 'engineer',
            ],
            [
                'code' => 'BXX',
                'position_name' => 'Building Foundation/Sub-Structure',
                'category' => 'engineer',
            ],
            [
                'code' => 'A-04',
                'position_name' => 'Marine Structure Engineer 2 ( Car Terminal)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B15',
                'position_name' => 'Claim Expert PKG 5 & PKG 6',
                'category' => 'Engineer',
            ],
            [
                'code' => 'AXX',
                'position_name' => 'Site Coordinator (P5/P6)/Geotechnical Engineer',
                'category' => 'engineer',
            ],
            [
                'code' => 'B2.2',
                'position_name' => 'Dredging Engineer 2',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B05.1',
                'position_name' => 'Civil Engineer 1 (Yard PKG6)',
                'category' => 'engineer',
            ],
            [
                'code' => 'A-08',
                'position_name' => 'Electrical Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C06',
                'position_name' => 'CAD Operator',
                'category' => 'supporting',
            ],
            [
                'code' => 'B99',
                'position_name' => 'QC Staff',
                'category' => 'Supporting',
            ],
            [
                'code' => 'B01',
                'position_name' => 'Local Team Leader/Senior Structure',
                'category' => 'engineer',
            ],
            [
                'code' => 'B14',
                'position_name' => 'Geotechnical Engineer',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B2.1',
                'position_name' => 'Dredging Engineer 1 (PKG 6)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-05',
                'position_name' => 'Soil Mechanic Engineer 1',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-14',
                'position_name' => 'Port Security Expert (ISPS)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'A-19',
                'position_name' => 'Environmental Expert (Social)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B03',
                'position_name' => 'Marine Structural Engineer 1',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C05',
                'position_name' => 'Cad operator',
                'category' => 'supporting',
            ],
            [
                'code' => 'B10.3',
                'position_name' => 'Co-team Leader',
                'category' => 'Engineer',
            ],
            [
                'code' => 'B06',
                'position_name' => 'Civil Engineer-2 (Reclamation)',
                'category' => 'Engineer',
            ],
            [
                'code' => 'C13.1',
                'position_name' => 'Document Controller 2',
                'category' => 'supporting',
            ],
            [
                'code' => 'B14.1',
                'position_name' => 'Geotechnical Engineer',
                'category' => 'Engineer',
            ],
        ];
        
        foreach ($positions as $position) {
            $position['created_at'] = now()->addMinute(1);
            $position['updated_at'] = now()->addMinute();
            Position::create($position);
        }
    }
}
