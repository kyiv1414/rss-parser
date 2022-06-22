<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Console\Command;

class ParseLifehacker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:lifehacker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command parse';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $feed = \Feeds::make(env('PARSE_URL'));

        foreach ($feed->get_items() as $item) {

            $post = new Post([
                'title' => $item->get_title(),
                'description' => substr($item->get_description(), 0, 100),
                'link' => $item->get_permalink(),
            ]);

            $categories = array();
            foreach ($item->get_categories() as $item_category) {
                array_push($categories, $item_category->get_label());
            }

            $post->save();
            $post->add_categories($categories);
        }
        return 0;
    }

}
