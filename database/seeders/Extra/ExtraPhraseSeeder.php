<?php

namespace Database\Seeders\Extra;

use App\Models\ExtraPhrase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraPhraseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"No estés triste por haberlo perdido, sé feliz por haberlo tenido."',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"La vida la tenes que vivir, no te limites solo a existir."',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"Si sientes que lo estás perdiendo todo, recuerda que los árboles pierden sus hojas cada año, pero siguen erguidos esperando que lleguen días mejores."',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"La suerte es amiga de la acción."',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"La serenidad es el mejor regalo que puede darnos la naturaleza ".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"Trata a todos como si fueran tus hermanos, aunque sea la primera vez que los conoces".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"Tal y como haces algo, lo haces todo".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"Hara Hachi Bu, come hasta el 80% de tus posibilidades".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"Si te das 30 dias para limpiar tu casa, te tomara 30 dias. Pero si te das 3 horas, solo te tomara 3 horas".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));

        ExtraPhrase::create(array(
            'name' => '',
            'description' => '"El pasado puede doler. Pero segun lo veo, puedes o huir de el, o aprender".',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));
    }
}
