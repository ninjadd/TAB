<?php

use Faker\Generator as Faker;
use App\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$factory->define(App\KnowledgeBase::class, function (Faker $faker) {
    $title = $faker->words(3, true);
    $title = ucwords($title);
    $body = $faker->randomHtml();
    $body = str_replace('<html>', '', $body);
    $body = str_replace('<head>', '', $body);
    $body = str_replace('<title>', '<p>', $body);
    $body = str_replace('</html>', '', $body);
    $body = str_replace('</head>', '', $body);
    $body = str_replace('</title>', '</p>', $body);
    $body = str_replace("\n", '', $body);
    $organization = Organization::inRandomOrder()->first();
    $user_id = DB::table('organization_user')->where('organization_id', '=', $organization->id)->inRandomOrder()->first()->user_id;

    return [
        'user_id' => $user_id,
        'organization_id' => $organization->id,
        'title' => $title,
        'slug' => str_slug($title).'-'.Carbon::now()->timestamp,
        'body' => $body
    ];
});
