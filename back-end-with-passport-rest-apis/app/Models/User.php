<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    protected $primaryKey = "id";
    protected $table = "users";
    public $incrementing = false;

    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function checkUser($email)
    {
        try {
            $result = $this->where("email", $email)->first();
            if ($result) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info("UserModel Error", ["register" => $ex->getMessage(), "line" => $ex->getLine()]);
            return false;
        }
    }

    public function register($name, $email, $password)
    {
        try {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            if ($this->save()) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info("UserModel Error", ["register" => $ex->getMessage(), "line" => $ex->getLine()]);
            return false;
        }
    }

    public function getSingleUser($email)
    {
        try {
            $user_email = $this->where('email', $email)->first();
            if ($user_email) {
                return $user_email;
            }
            return null;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['getSingleUser' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return null;
        }
    }

    public function getProfile($email)
    {
        try {
            $result = $this->where('email', $email)->first();
            if ($result) {
                return $result;
            }
            return null;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['getProfile' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return null;
        }
    }

    public function updatePassword($email, $hashPassword)
    {
        try {
            $result = $this->where('email', $email)
                ->update(['password' => $hashPassword]);
            if ($result) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['resetPassword' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return false;
        }
    }

    public function updateSetting($email, $setting_name, $setting_value)
    {
        try {
            $query = $this->newQuery();
            $query->where('email', $email);
            if ($setting_name == "email_follow_me") {
                $query->update(['email_follow_me' => $setting_value]);
            } elseif ($setting_name == "email_answers_my_post") {
                $query->update(['email_answers_my_post' => $setting_value]);
            } elseif ($setting_name == "email_someone_mentions_me") {
                $query->update(['email_someone_mentions_me' => $setting_value]);
            } elseif ($setting_name == "new_launches_projects") {
                $query->update(['new_launches_projects' => $setting_value]);
            } elseif ($setting_name == "monthly_product_updates") {
                $query->update(['monthly_product_updates' => $setting_value]);
            } elseif ($setting_name == "subscribe_to_newsletter") {
                $query->update(['subscribe_to_newsletter' => $setting_value]);
            } else {
                return false;
            }
            if ($query) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['updateSetting' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return false;
        }
    }

    public function updateProfileHeadline($email, $name, $headline)
    {
        try {
            $result = $this->where('email', $email)
                ->update(['name' => $name, 'title' => $headline]);
            if ($result) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['updateProfileHeadline' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return false;
        }
    }

    public function updateProfileInformation($email, $name, $mobile, $description, $location)
    {
        try {
            $result = $this->where('email', $email)
                ->update(['name' => $name, 'mobile' => $mobile, 'description' => $description, 'location' => $location]);
            if ($result) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info('UserModel Error', ['updateProfileInformation' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return false;
        }
    }


}
