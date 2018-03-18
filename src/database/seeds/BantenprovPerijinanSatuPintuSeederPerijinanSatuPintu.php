<?php

/* Require */
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/* Models */
use Bantenprov\PerijinanSatuPintu\Models\Bantenprov\PerijinanSatuPintu\PerijinanSatuPintu;

class BantenprovPerijinanSatuPintuSeederPerijinanSatuPintu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
        Model::unguard();

        $perijinan_satu_pintus = (object) [
            (object) [
                'user_id' => '1',
                'group_egovernment_id' => '1',
                'label' => 'GroupEgovernment 1',
                'description' => 'GroupEgovernment satu'
            ],
            (object) [
                'user_id' => '2',
                'group_egovernment_id' => '2',
                'label' => 'GroupEgovernment 2',
                'description' => 'GroupEgovernment dua',
            ]
        ];

        foreach ($perijinan_satu_pintus as $perijinan_satu_pintu) {
            $model = PerijinanSatuPintu::updateOrCreate(
                [
                    'user_id' => $perijinan_satu_pintu->user_id,
                    'group_egovernment_id' => $perijinan_satu_pintu->group_egovernment_id,
                    'label' => $perijinan_satu_pintu->label,
                    'description' => $perijinan_satu_pintu->description,
                ]
            );
            $model->save();
        }
	}
}
