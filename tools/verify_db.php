<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "ROLES:\n";
foreach (DB::table('roles')->get() as $r) {
    echo $r->id . ' ' . $r->name . PHP_EOL;
}

echo PHP_EOL . "USERS:\n";
foreach (DB::table('users')->select('id','name','email','role_id')->get() as $u) {
    echo $u->id . ' ' . $u->email . ' role:' . $u->role_id . PHP_EOL;
}

echo PHP_EOL . "PASSWORD CHECKS:\n";
$emails = ['customer@example.com','catering@example.com','decorator@example.com'];
foreach ($emails as $e) {
    $u = DB::table('users')->where('email', $e)->first();
    if ($u) {
        echo $e . ' ' . (Hash::check('password', $u->password) ? 'OK' : 'NO') . PHP_EOL;
    } else {
        echo $e . ' MISSING' . PHP_EOL;
    }
}

echo PHP_EOL . "COUNTS:\n";
echo 'events:' . DB::table('events')->count() . PHP_EOL;
echo 'services:' . DB::table('services')->count() . PHP_EOL;
echo 'bookings:' . DB::table('bookings')->count() . PHP_EOL;
