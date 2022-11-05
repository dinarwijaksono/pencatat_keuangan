<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Category_service;
use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Category_controllerApi extends Controller
{
    private $category_service;
    private $user_service;

    function __construct(Category_service $category_service, User_service $user_service)
    {
        $this->category_service = $category_service;
        $this->user_service = $user_service;
    }


    public function createCategory(Request $request)
    {
        $validatorCode = Validator::make($request->all(), [
            'code' => 'required|exists:users,code'
        ]);

        if ($validatorCode->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Masalah authentication.'
            ]);
        };

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data yang di kirim tidak lengkap',
                'data' => [
                    'name' => [
                        'isError' => !empty($validator->errors()->first('name')),
                        'message' => $validator->errors()->first('name'),
                    ],
                    'type' => [
                        'isError' => !empty($validator->errors()->first('type')),
                        'message' => $validator->errors()->first('type')
                    ]
                ]
            ]);
        }


        if (!in_array(strtolower($request->type), ['pemasukan', 'pengeluaran'])) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal input kategori.',
                'data' => [
                    'name' => [
                        'isError' => false,
                    ],
                    'type' => [
                        'isError' => true,
                        'message' => 'Data salah.'
                    ]
                ]
            ]);
        }

        $user_id = $this->user_service->getIdWhereCode($request->code);

        // cek apakah user sudah mempunyai category yang sama
        $category = collect($this->category_service->getAll($user_id));
        $category = collect($category->where('name', strtolower($request->name)));
        return $category;

        if ($category->isNotEmpty()) {
            $type = $request->type == "pemasukan" ? 1 : 0;
            if ($category->where('type', $type)->isNotEmpty()) {

                return response()->json([
                    'status' => 'failed',
                    'message' => "Kategori dengan nama $request->name dan bertype $request->type, sudah ada. ",
                    'data' => [
                        'name' => [
                            'isError' => false,
                        ],
                        'type' => [
                            'isError' => false,
                        ]
                    ]
                ]);
            }
        }




        $this->category_service->addCategory($user_id, $request->name, $request->type);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil di simpan.'
        ]);
    }
}
