<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Reporter;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reporter::with('berita')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
                "nama" => "required",
                "jenis_kelamin" => "required",
                "alamat" => "required",
                "email" => "required",
                "news_id" => "required"
        ]);

        if ($validasi->passes()) {
            return response()->json([
                'pesan' => "Data Berhasil disimpan",
                'data' => Reporter::create($request->all())
            ]);
        }
        return response()->json([
            'pesan' => 'Data Gagal ditambahkan',
            'data' => $validasi->errors()->all()
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        $detail = Reporter::where('id', $data)->with('berita')->first();


        if (empty($detail)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'pesan' => 'Data Berhasil ditemukan',
            'data' => $detail
        ], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Reporter::where('id', $id)->first();

        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        } else {

            $validasi = Validator::make($request->all(), [
                "nama" => "required",
                "jenis_kelamin" => "required",
                "alamat" => "required",
                "email" => "required",
                "news_id" => "required",
            ]);

            if ($validasi->passes()) {
                return response()->json([
                    'pesan' => "Data Berhasil disimpan",
                    'data' => $data->update($request->all())
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Data Gagal di Update',
                    'data' => $validasi->errors()->all()
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        $detail = Reporter::where('id', $data)->first();

        if (empty($detail)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
        $detail->delete();
        return response()->json([
            'pesan' => 'Data Berhasil Dihapus',
            'data' => $detail
        ], 200);
    }
}
