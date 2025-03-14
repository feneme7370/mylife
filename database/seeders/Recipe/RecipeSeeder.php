<?php

namespace Database\Seeders\Recipe;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipe::create(array(
            'title' => 'Focaccia',
            'slug' => \Illuminate\Support\Str::slug('Focaccia'),
            'synopsis' => 'Pan que se deja levar mucho',
            'ingredients' => '<ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Harina: 600 g</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Levadura seca: 7 g</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Sal: a gusto</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Agua : 500 ml</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Aceite de oliva: a gusto</li></ol>',
            'steps' => '<p>En mi caso yo tenía pechugas enteras pero ustedes pueden pedirlas fileteadas, yo tuve que filetear las mías. Fileteamos las pechugas y hacemos una mezcla integrando los huevos con la leche y los condimentos. Les recomiendo también salar las pechugas para evitar que queden desabridas.</p><p><a href="https://www.conasi.eu/blog/wp-content/uploads/2022/02/como-hacer-focaccia-desdes.jpg" rel="noopener noreferrer" target="_blank"><img src="https://img-global.cpcdn.com/steps/b1ee3b3208806238/160x128cq70/foto-del-paso-1-de-la-receta-milanesas-de-pollo-faciles-y-deliciosas.jpg" alt="Foto del paso 1 de la receta: Milanesas de pollo fáciles y deliciosas" height="128" width="160"></a> <a href="https://cookpad.com/ar/step_attachment/images/5fad27571a6a2b66?image_region_id=4" rel="noopener noreferrer" target="_blank"><img src="https://img-global.cpcdn.com/steps/5fad27571a6a2b66/160x128cq70/foto-del-paso-1-de-la-receta-milanesas-de-pollo-faciles-y-deliciosas.jpg" alt="Foto del paso 1 de la receta: Milanesas de pollo fáciles y deliciosas" height="128" width="160"></a></p><p>2</p><p>Pasamos las pechugas por el huevo y después por el pan rallado (este proceso pueden hacerlo varias veces hasta tener un rebozado más grueso, en mi caso lo hice una sola vez porque me gusta el rebozado fino)</p><p><br></p><p><a href="https://cookpad.com/ar/step_attachment/images/7fe42a614e94cb47?image_region_id=4" rel="noopener noreferrer" target="_blank"><img src="https://img-global.cpcdn.com/steps/7fe42a614e94cb47/160x128cq70/foto-del-paso-2-de-la-receta-milanesas-de-pollo-faciles-y-deliciosas.jpg" alt="Foto del paso 2 de la receta: Milanesas de pollo fáciles y deliciosas" height="128" width="160"></a></p><p>3</p><ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span>Precalentamos el horno unos 10 minutos antes de meterlas milas. Pasamos las milanesas ya terminadas a una fuente aceitada (pueden hacerlas fritas también) y al horno por unos 25 minutos hasta que doren de ambos lados. Y listo tenés tus milas caseras para acompañar con lo que se te ocurra.</li></ol>',
            'cover_image_url' => 'https://www.conasi.eu/blog/wp-content/uploads/2022/02/como-hacer-focaccia-desdes.jpg',
            'uuid' => \Illuminate\Support\Str::random(24),
            'user_id' => '1',
        ));
    }
}
