<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        Post::truncate();
        Category::truncate();
        Tag::truncate();

        $category = new Category;
        $category->name =  "Categoria 1";
        $category->save();

        $category = new Category;
        $category->name =  "Categoria 2";
        $category->save();

        // 1
        $post = new Post;
        $post->title = "STAMPE DIGITALI";
        $post->url = str_slug("STAMPE DIGITALI");
        $post->excerpt = "extracto de mi primer post";
        $post->body = "La stampa digitale è il metodo più innovativo degli ultimi anni. 
        Consente di trasformare direttamente un file nel prodotto, abbattendo così i costi della stampa tradizionale. 
        Grazie all’esperienza grafica del nostro personale, dei vari sistemi di stampa e dei supporti cartacei dei quali disponiamo, siamo in grado di soddisfare le vostre esigenze sia per la stampa, sia per la progettazione di ogni genere di prodotto finito, dalla brochure al biglietto da visita, dalla carta intestata ai volantini e molto altro ancora. 
        Chiamateci per qualsiasi dubbio o necessità.";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post->tags()->sync(Tag::create(['name' => 'etiqueta 1']));

        // 2
        $post = new Post;
        $post->title = "STAMPE CAD";
        $post->url = str_slug("STAMPE CAD");
        $post->excerpt = "extracto de mi segundo post";
        $post->body = "Eseguiamo stampe CAD sia a colori che in bianco e nero direttamente da files DWG inviandoli via email o caricandoli sul nostro spazio FTP. 
        Riproduzioni XEROGRAFICHE da originale cartaceo in brevissimo tempo ed a basso costo.";
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->user_id = 2;
        $post->save();

        $post->tags()->sync(Tag::create(['name' => 'etiqueta 3']));


        // 3
        $post = new Post;
        $post->title = "Mi tercero post";
        $post->url = str_slug("Mi tercero post");
        $post->excerpt = "extracto de mi tercero post";
        $post->body = "<p>Contenido de mi tercero post</p>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post->tags()->sync(Tag::create(['name' => 'etiqueta 4']));

        // 4
        $post = new Post;
        $post->title = "Mi cuarto post";
        $post->url = str_slug("Mi cuarto post");
        $post->excerpt = "extracto de mi cuarto post";
        $post->body = "<p>Contenido de mi cuarto post</p>";
        $post->published_at = Carbon::now()->subDays(6);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post->tags()->sync(Tag::create(['name' => 'etiqueta 5']));

    }
}
