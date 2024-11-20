<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Lấy danh sách tất cả khách hàng
    public function index()
    {
        return Customer::getAllCustomers();
    }

    // Thêm khách hàng mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:customers,email',
            'address' => 'nullable|string|max:255',
            'balance' => 'required|numeric|min:0'
        ]);

        return Customer::createCustomer($validatedData);
    }

    // Xem thông tin một khách hàng cụ thể
    public function show($id)
    {
        return Customer::getCustomerById($id);
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'email|unique:customers,email,' . $id,
            'address' => 'nullable|string|max:255',
            'balance' => 'numeric|min:0'
        ]);

        return Customer::updateCustomer($validatedData, $id);
    }

    // Xóa một khách hàng
    public function destroy($id)
    {
        return Customer::deleteCustomer($id);
    }
}
