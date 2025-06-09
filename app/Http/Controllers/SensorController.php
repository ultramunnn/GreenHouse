<?php

namespace App\Http\Controllers;

use App\Models\TransaksiSensor;
use App\Models\MasterDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Controller untuk mengelola operasi terkait sensor
 * Menangani permintaan HTTP untuk data sensor dan perangkat
 */
class SensorController extends Controller
{
    /**
     * Menyimpan data pembacaan sensor ke database
     * Menggunakan transaksi database untuk memastikan integritas data
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Mencatat detail request untuk keperluan debugging
            Log::info('=== START SENSOR UPDATE ===');
            Log::info('Request Method: ' . $request->method());
            Log::info('Request URL: ' . $request->url());
            Log::info('Request Headers:', $request->headers->all());
            Log::info('Request Body:', $request->all());

            // Validasi input yang masuk
            $validated = $request->validate([
                'masterdevice_id' => 'required|integer|exists:masterdevice,id',    // Memastikan device ada di database
                'nilai' => 'required|numeric',                                      // Nilai sensor harus berupa angka
                'waktu_pencatatan' => 'required|date_format:Y-m-d H:i:s',          // Format waktu yang valid
            ]);

            Log::info('Validation passed. Validated data:', $validated);

            // Memeriksa keberadaan master device
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
                // Update atau buat record untuk device ini
                $transaksiSensor = TransaksiSensor::updateOrCreate(
                    ['masterdevice_id' => $validated['masterdevice_id']],
                    [
                        'nilai' => $validated['nilai'],
                        'waktu_pencatatan' => $validated['waktu_pencatatan']
                    ]
                );

                Log::info('TransaksiSensor data:', $transaksiSensor->toArray());

            } catch (Exception $e) {
                Log::error('Error updating TransaksiSensor:', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'data' => $validated
                ]);
                throw $e;
            }

            DB::commit();
            Log::info('Transaction committed successfully');
            Log::info('=== END SENSOR UPDATE ===');

            return response()->json([
                'message' => 'Data berhasil diupdate',
                'data' => $transaksiSensor
            ], 200);

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
                'error' => 'Terjadi kesalahan saat mengupdate data sensor',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mengambil semua data sensor
     * Mengembalikan data dalam format JSON
     */
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

    /**
     * Menampilkan halaman dashboard dengan data sensor
     * Mengambil data device dan transaksi sensor terbaru
     */
    public function dashboard()
    {
        // Implementasi method dashboard
    }

    /**
     * Mengambil data sensor terbaru untuk ditampilkan
     * Digunakan untuk pembaruan real-time pada dashboard
     */
    public function getLatestSensorData()
    {
        // Implementasi method getLatestSensorData
    }
}
