<?php

use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'image' => 'phpzMzqqi/twlqtwycAe8gYaUSEYlNb1m4h6NYF3ic5XpPH67t.jpg'
            ],
            [
                'image' => 'phpZOX7L0/2PQBg300HLNeKpDIeclgAL0LKuJ7NNWLVas6wPsq.png'
            ],
            [
                'image' => 'phpyBdkP0/10C5oLg0byHc76HvxDMOS0rHWkLNzgqsHl89Mugj.jpg'
            ],
            [
                'image' => 'phpVL82N2/josjLSKZDUiNssawdpZgkMLUPMMLUDBs1EUUelRI.png'
            ],
        ];
        \App\Models\Slider::insert($sliders);
    }
}
