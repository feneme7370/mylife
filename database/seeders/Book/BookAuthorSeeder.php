<?php

namespace Database\Seeders\Book;

use App\Models\BookAuthor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookAuthor::create(array('name' => 'Debra Austin','slug' => \Illuminate\Support\Str::slug('Debra Austin'),'description' => 'Hija de Kura está ambientada en el sureste de África hace aproximadamente medio millón de años. Sus personajes son humanos en el sentido de ser antepasados ​​de los humanos modernos, pero son de otra especie: Homo erectus o Homo ergaster, dependiendo del sistema de denominación que se utilice. El mundo de Snap se basa en parte en el trabajo de científicos: paleoantropólogos, biólogos evolutivos y psicólogos evolutivos.','cover_image_url' => 'https://images.gr-assets.com/authors/1234968500p5/2828986.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => NULL, 'country' => ''));
        
        BookAuthor::create(array('name' => 'Paula Gallego','slug' => \Illuminate\Support\Str::slug('Paula Gallego'),'description' => 'Paula Gallego nació en San Sebastián, en 1995. Es filóloga y graduada en Magisterio Infantil con el minor de Educación Especial. También tiene un máster en Creación Literaria. Vive cerca de San Sebastián con su novio y sus tres gatos. Le gustan las plantas, aunque se le mueren todas, el mar y las librerías de estanterías infinitas, los villanos y el tópico literario enemies to lovers.','cover_image_url' => 'https://images.gr-assets.com/authors/1608767330p5/8297676.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => '2015-04-01', 'country' => 'San Sebastián, Spain'));

        BookAuthor::create(array('name' => 'James Clear','slug' => \Illuminate\Support\Str::slug('James Clear'),'description' => 'James Clear is the author of "Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones"

He writes about habits, decision-making, and continuous improvement at jamesclear.com. His website receives millions of visitors each month and hundreds of thousands subscribe to his popular email newsletter.

His work has appeared in the New York Times, Entrepreneur, Time, and on CBS This Morning. He is a regular speaker at Fortune 500 companies and his work is used by teams in the NFL, NBA, and MLB.

Learn more at jamesclear.com ','cover_image_url' => 'https://images.gr-assets.com/authors/1393075384p5/7327369.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => '2012-06-01', 'country' => ''));

        BookAuthor::create(array('name' => 'Brian Alba','slug' => \Illuminate\Support\Str::slug('Brian Alba'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1'));

        BookAuthor::create(array('name' => 'Ken Mogi','slug' => \Illuminate\Support\Str::slug('Ken Mogi'),'description' => 'Kenichirō "Ken" Mogi (茂木 健一郎 Mogi Kenichirō) es un científico japonés. Es investigador principal de Sony Computer Science Laboratories y profesor invitado en el Instituto de Tecnología de Tokio. Según el perfil publicado en su blog personal, su misión es "resolver el llamado problema mente-cerebro".

Después de graduarse en ciencias en la Universidad de Tokio en 1985 y en derecho en 1987, Mogi recibió en 1992 un doctorado. con la tesis "Modelo Matemático de Contracción Muscular".

Ken Mogi fue el primer orador TED de Japón. Se presentó en marzo de 2012.

Mogi ha publicado más de 50 libros, la mayoría de los cuales están escritos en japonés. Abarcan no solo las ciencias del cerebro, sino que también incluyen, entre otras, filosofía, historia, arte, educación y lingüística. Sus libros se han utilizado frecuentemente como fuente de exámenes de acceso a la universidad. Su libro "Nō to Kasō" (脳と仮想, "Cerebro e imaginación") recibió el premio Hideo Kobayashi en 2005, y otro libro "Ima Koko kara Subete no Basho e" (今ここからすべての場所へ, "De aquí a todas partes") recibió el Takeo 2008. Premio académico Kuwabara.','cover_image_url' => 'https://images.gr-assets.com/authors/1549928491p5/17093325.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => '2012-06-01', 'country' => 'Tokyo, Japan '));

        BookAuthor::create(array('name' => 'Ken Eckhart Tolle','slug' => \Illuminate\Support\Str::slug('Ken Eckhart Tolle'),'description' => 'Eckhart Tolle es profesor, autor y empresario. Es un residente de Canadá nacido en Alemania mejor conocido como el autor de El poder del ahora y Una nueva tierra: el despertar al propósito de tu vida. Tolle no se identifica con ninguna religión específica, pero ha sido influenciado por múltiples obras espirituales.','cover_image_url' => 'https://images.gr-assets.com/authors/1505974741p5/4493.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => '1948-02-16', 'country' => ' Dortmund, Germany '));

        BookAuthor::create(array('name' => 'Ken Laura Gallego García','slug' => \Illuminate\Support\Str::slug('Ken Laura Gallego García'),'description' => 'Laura Gallego García es una autora española de literatura infantil y juvenil especializada en fantasía y ciencia ficción.

Es una figura reconocida de la literatura española contemporánea: ha escrito más de 40 títulos, que han sido traducidos a decenas de idiomas y vendidos millones de ejemplares en todo el mundo.','cover_image_url' => 'https://images.gr-assets.com/authors/1398792330p5/228898.jpg','uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => '1977-10-11', 'country' => 'Quart de Poblet, Valencia, Spain '));

        BookAuthor::create(array('name' => 'T. J. Klune','slug' => \Illuminate\Support\Str::slug('T. J. Klune'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => NULL, 'country' => ''));
        BookAuthor::create(array('name' => 'Spencer Johnson','slug' => \Illuminate\Support\Str::slug('Spencer Johnson'),'description' => NULL,'cover_image_url' => NULL,'uuid' => \Illuminate\Support\Str::random(24),'user_id' => '1', 'birthdate' => NULL, 'country' => ''));
        
    }
}
