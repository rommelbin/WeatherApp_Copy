<?php

namespace App\Models;

use App\Exceptions\CustomException;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Http\Request;

class City extends BaseModel
{
    use Authenticatable, Authorizable, hasFactory;

    protected $fillable = [
        'name', "api_city_id"
    ];
    protected $hidden = [
        "api_city_id"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "city_user");
    }

    /**
     * @throws CustomException
     */
    public static function add(Request $request): void
    {
        try {
            User::find(auth()->id())
                ->cities()
                ->attach($request->get('id'));
        } catch (\Exception $e) {
            throw new CustomException("Problems with backend", 401);
        }
    }

    /**
     * @throws CustomException
     */
    public static function remove(Request $request): void
    {
        try {
            User::find(auth()->id())
                ->cities()
                ->detach($request->get('id'));
        } catch (\Exception $e) {
            throw new CustomException("Problems with backend", 401);
        }

    }

    public static function get(Request $request): array
    {
        try {
            return is_null($request->id) ? self::getAll() : self::getOne($request->id);

        } catch (\Exception $e) {

            throw new CustomException("Problems with backend", 401);
        }
    }

    public static function getOne(int $id): array
    {
        return City::find($id)->toArray();
    }

    public static function getAll(): array
    {
        return City::all()->toArray();
    }

    public static function getFavourite(): array
    {
        try {
            return User::find(auth()->id())
                ->cities()
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            throw new CustomException("Problems with backend", 401);
        }
    }
}

