<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admin extends Model
{
    use HasFactory;
    public static function login($user, $pass)
    {
        try {
            $checkErr = DB::select('select * from admin where user_name = ?', [$user]);
            if ($checkErr === '') {
                return false;
            }
        } catch (Exception $err) {
            return false;
        }
        try {
            return DB::select('select * from admin where user_name = ? and password = ?', [$user, $pass]);
        } catch (Exception $err) {
            return false;
        }
    }
    static function getAllWareHouse()
    {
        return DB::table('warehouse')->select('*')
            ->get();
    }

    static function createWarehouse($name, $address, $avt, $status)
    {
        try {
            DB::insert('INSERT INTO `warehouse`(`name`, `address`, `status`, `avatar`) VALUES (?, ?, ?, ?)', [$name, $address, $status, $avt]);
        } catch (Exception $err) {
            return false;
        }
        return true;
    }
}
