<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


/**
 * @SWG\Definition(
 *      definition="User",
 *      title="User",
 *      type="object",
 *      @SWG\Property(property="id", type="integer"),
 *      @SWG\Property(property="first_name", type="string"),
 * 	    @SWG\Property(property="last_name", type="string"),
 *      @SWG\Property(property="username", type="string"),
 *      @SWG\Property(property="email", type="string"),
 *      @SWG\Property(property="email_verified_at", type="string"),
 *      @SWG\Property(property="created_at", type="string"),
 *      @SWG\Property(property="updated_at", type="string"),
 *      @SWG\Property(
 *          property="roles",
 *          @SWG\Items(
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="name", type="string"),
 *              @SWG\Property(property="guard_name", type="string"),
 *              @SWG\Property(property="created_at", type="string"),
 *              @SWG\Property(property="updated_at", type="string"),
 *          )
 *      ),
 * )
 * 
 */
class User extends Authenticatable
{
    use HasRoles, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     * 
     * 
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guard_name = 'api';

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
