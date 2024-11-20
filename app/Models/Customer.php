<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_number', 'email', 'address', 'balance'];

    // Lấy tất cả khách hàng
    public static function getAllCustomers()
    {
        return self::all();
    }

    // Tạo khách hàng mới
    public static function createCustomer($data)
    {
        return self::create($data);
    }

    // Lấy thông tin khách hàng dựa trên ID
    public static function getCustomerById($id)
    {
        return self::find($id) ?? response()->json(['message' => 'Customer not found'], 404);
    }

    // Cập nhật khách hàng
    public static function updateCustomer($data, $id)
    {
        $customer = self::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->update($data);
        return $customer;
    }

    // Xóa khách hàng
    public static function deleteCustomer($id)
    {
        $customer = self::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
