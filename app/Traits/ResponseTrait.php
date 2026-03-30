<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;

trait ResponseTrait
{

    public function sendResponse($result = [], $message = 'Success', $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendError($error = 'サーバーエラーが発生しました。', $errorMessages = [], $code = 500)
    {
        // if MessageBag error , convert it to string
        if (is_object($error)) {
            if ($error instanceof \Illuminate\Support\MessageBag) {
                $errors_arr = $error->toArray();
                $error = "";
                foreach ($errors_arr as $err_arr) {
                    foreach ($err_arr as $err) {
                        $error .= $err;
                    }
                }
            }
        }

        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendResponseWithPagination($result, $message, $code = 200)
    {
        return Response::withPagination($result, $message, $code);
    }

    public function sendResponseWithCustomePagination($result, $pagination, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'pagination'    => $pagination,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendResponseWithStock($result, $shipping_fee, $tax_price, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'shipping_fee'    => $shipping_fee,
            'tax_price'    => $tax_price,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendResponseWithStockNew($result, $tax_price, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'tax_price'    => $tax_price,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
