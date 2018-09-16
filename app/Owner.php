<?php

namespace App;

use LaravelEnso\Contacts\app\Traits\Contactable;
use LaravelEnso\Core\app\Models\Owner as Owners;
use LaravelEnso\ActivityLog\app\Traits\LogActivity;
use LaravelEnso\Discussions\app\Traits\Discussable;
use LaravelEnso\CommentsManager\app\Traits\Commentable;
use LaravelEnso\AddressesManager\app\Traits\Addressable;
use LaravelEnso\DocumentsManager\app\Traits\Documentable;

class Owner extends Owners
{
    use Contactable, Commentable, Discussable, Documentable, Addressable, LogActivity;

    protected $fillable = ['name', 'description', 'is_active'];

    protected $attributes = ['is_active' => false];

    protected $casts = ['is_active' => 'boolean'];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'description', 'is_active' => 'active state'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
