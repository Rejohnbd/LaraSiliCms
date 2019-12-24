<?php

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name'      => 'Rejohn Bd',
            'email'     => 'rejohnbd@gmail.com',
            'password'  => Hash::make('password')
        ]);

        $author2 = User::create([
            'name'      => 'Atik',
            'email'     => 'atik@gmail.com',
            'password'  => Hash::make('password')
        ]);

        $category1 = Category::create([
            'name' => 'News'
        ]);

        $category2 = Category::create([
            'name' => 'Marketing'
        ]);

        $category3 = Category::create([
            'name' => 'Partnership'
        ]);

        $tag1 = Tag::create([
            'name' => 'job'
        ]);
        
        $tag2 = Tag::create([
            'name' => 'customers'
        ]);

        $tag3 = Tag::create([
            'name' => 'record'
        ]);

        $post1 = Post::create([
            'title'         => 'We relocated our office to a new designed garage',
            'description'   => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',
            'content'       => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
            'category_id'   => $category1->id,
            'image'         => 'posts/4.jpg',
            'user_id'       => $author1->id
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',
            'content'   => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
            'category_id' => $category2->id,
            'image' => 'posts/1.jpg'
        ]);

        $post3 =  $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',
            'content'   => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
            'category_id' => $category3->id,
            'image' => 'posts/2.jpg'
        ]);

        $post4 =  $author2->posts()->create([
            'title' => 'New published books to read by a product designer',
            'description' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',
            'content'   => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
            'category_id' => $category2->id,
            'image' => 'posts/3.jpg'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag3->id, $tag1->id]);
    }
}
