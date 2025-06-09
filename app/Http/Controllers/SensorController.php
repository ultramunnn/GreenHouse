<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSensor;
use App\Models\MasterDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Log detail request
            Log::info('=== START SENSOR STORE/UPDATE ===');
            Log::info('Request Method: ' . $request->method());
            Log::info('Request URL: ' . $request->url());
            Log::info('Request Headers:', $request->headers->all());
            Log::info('Request Body:', $request->all());

            // Validasi data yang masuk
            $validated = $request->validate([
                'masterdevice_id' => 'required|integer|exists:masterdevice,id',
                'nilai' => 'required|numeric',
                'waktu_pencatatan' => 'required|date_format:Y-m-d H:i:s',
            ]);

            Log::info('Validation passed. Validated data:', $validated);

            // Periksa apakah masterdevice ada
            $masterDevice = MasterDevice::find($validated['masterdevice_id']);
            if (!$masterDevice) {
                Log::error('MasterDevice not found:', ['id' => $validated['masterdevice_id']]);
                DB::rollBack();
                return response()->json([
                    'error' => 'MasterDevice tidak ditemukan',
                    'masterdevice_id' => $validated['masterdevice_id']
                ], 404);
            }

            Log::info('MasterDevice found:', $masterDevice->toArray());

            try {
                // Buat record baru untuk setiap pembacaan sensor
                $transaksiSensor = new TransaksiSensor();
                $transaksiSensor->masterdevice_id = $validated['masterdevice_id'];
                $transaksiSensor->nilai = $validated['nilai'];
                $transaksiSensor->waktu_pencatatan = $validated['waktu_pencatatan'];
                
                // Timestamps akan diupdate otomatis oleh Laravel
                $saved = $transaksiSensor->save();

                Log::info('Save result:', ['saved' => $saved]);
                Log::info('TransaksiSensor data:', $transaksiSensor->toArray());

                if (!$saved) {
                    throw new Exception('Failed to save TransaksiSensor');
                }

            } catch (Exception $e) {
                Log::error('Error saving TransaksiSensor:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'data' => $validated
                ]);
                throw $e;
            }

            DB::commit();
            Log::info('Transaction committed successfully');
            Log::info('=== END SENSOR STORE/UPDATE ===');

            return response()->json([
                'message' => 'Data berhasil disimpan',
                'data' => $transaksiSensor
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error:', [
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ]);
            return response()->json([
                'error' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Unexpected error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan data sensor',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $dataSensor = TransaksiSensor::with('masterDevice')->get();
            return response()->json($dataSensor);
        } catch (Exception $e) {
            Log::error('Error in sensor index:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengambil data sensor'
            ], 500);
        }
    }
}
