<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'id',
        'username',
        'first_name',
        'last_name'
    ];
}