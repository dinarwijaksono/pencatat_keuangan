<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Category_service;
use App\Services\User_service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class Category_controllerApi extends Controller
{
    private $category_service;
    private $user_service;

    public function __construct(Category_service $category_service, User_service $user_service)
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
                'message' => 'Anda belum login.'
            ]);
        };

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:30',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data yang di kirim salah.',
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

        $user_id = $this->user_service->getIdWhereCode($request->code)['id'];

        // cek apakah user sudah mempunyai category yang sama
        $category = collect($this->category_service->getListCategory($user_id));
        $category = collect($category->where('name', strtolower($request->name)));

        if ($category->isNotEmpty()) {
            $category = collect($category)->where('type', $request->type);
            if ($category->isNotEmpty()) {

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



    public function getListCategory($code)
    {
        $user_id = $this->user_service->getIdWhereCode($code);

        if ($user_id['status'] == 'failed') {
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda belum login.'
            ]);
        }

        $listCategory = $this->category_service->getListCategory($user_id['id']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'listCategory' => collect($listCategory)
            ]
        ]);
    }




    public function deleteCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'category_id' => 'required'
        ]);

        // cek validasi
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Kategori gagal di hapus.'
            ]);
        }

        $user_id = $this->user_service->getIdWhereCode($request->code);
        $category = $this->category_service->getCategory($request->category_id);

        // Cek kepemilikan categori
        if ($user_id['id'] !== $category['user_id']) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Kategori gagal di hapus.',
            ]);
        }

        $this->category_service->deleteCategory($request->category_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil di hapus'
        ]);
    }
}
