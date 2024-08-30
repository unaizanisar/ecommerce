<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\OrderRepositoryInterface;

class ApiOrderController extends Controller
{
    protected $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function index()
    {
        $orders = $this->orderRepository->getAllOrders();
        return response()->json($orders, 200);
    }
    public function show($id)
    {
        try{
            $order = $this->orderRepository->getOrderById($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Order not found'],404);
        }
        return response()->json($order, 200);
    }
    public function store(Request $request)
    {
        try{
        $validator = Validator::make($request->all(),[
            'firstname' =>  'required|max:255|string',
            'lastname' =>  'required|max:255|string',
            'email' =>  'required|max:255|string',
            'address' =>  'required|max:255|string',
            'phone' =>  'required|max:255|string',
            'city' =>  'required|max:255|string',
            'postal_code' =>  'required|max:255|string',
            'total' =>  'required|max:255|string',
        ]);
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()],422);
        }
        $data = $request->all();
        $order = $this->orderRepository->createOrder($data);
        return response()->json(['order'=>$order, 'message'=>'Order created successfully'], 200);
        } catch (\Exception $e){
            return response()->json(['error'=>'An error occured while creating order', 'message'=>$e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $validatedData = $request->validate([
                'firstname' =>  'required|max:255|string',
                'lastname' =>  'required|max:255|string',
                'email' =>  'required|max:255|string',
                'address' =>  'required|max:255|string',
                'phone' =>  'required|max:255|string',
                'city' =>  'required|max:255|string',
                'postal_code' =>  'required|max:255|string',
                'total' =>  'required|max:255|string',
            ]);
            $order = $this->orderRepository->getOrderById($id);
            if(!$order)
            {
                return response()->json(['error'=>'Order not found'], 404);
            }
            $data = $validatedData;
            $this->orderRepository->updateOrder($id, $data);
            return response()->json(['message'=>'Order updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error'=>'An error occured while updating order', 'message'=>$e->getMessage()],500);
        }
    }
    public function destroy($id)
    {
        try{
            $order = $this->orderRepository->deleteOrder($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Order not found'], 404);
        }
        return response()->json(['message'=>'Order deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $order = $this->orderRepository->updateOrderStatus($id, $status);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Order not found'], 404);
        }
        $message = $status == 1 ? 'Order activated successfully':'Order deactivated successfully';
        return response()->json(['message'=>$message], 200);
    }
}
