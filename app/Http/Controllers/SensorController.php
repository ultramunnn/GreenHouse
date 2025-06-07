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
                'waktu_pencatatan' => 'required|string',
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

            // Cari data sensor terakhir untuk device ini
            $transaksiSensor = TransaksiSensor::where('masterdevice_id', $validated['masterdevice_id'])
                ->orderBy('created_at', 'desc')
                ->first();

            try {
                if (!$transaksiSensor) {
                    // Jika belum ada data, buat baru
                    Log::info('Creating new TransaksiSensor record');
                    $transaksiSensor = new TransaksiSensor();
                    $transaksiSensor->masterdevice_id = $validated['masterdevice_id'];
                } else {
                    Log::info('Updating existing TransaksiSensor record:', $transaksiSensor->toArray());
                }

                // Update nilai
                $transaksiSensor->nilai = $validated['nilai'];
                
                // Format waktu pencatatan
                $waktuPencatatan = date('Y-m-d H:i:s');
                if ($validated['waktu_pencatatan'] !== 'now') {
                    // Jika waktu dikirim dari ESP32, gunakan waktu tersebut
                    $waktuPencatatan = $validated['waktu_pencatatan'];
                }
                
                $transaksiSensor->waktu_pencatatan = $waktuPencatatan;
                
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

            // Mengembalikan respons JSON dengan data yang disimpan/diupdate
            return response()->json([
                'message' => $transaksiSensor->wasRecentlyCreated ? 'Data berhasil disimpan' : 'Data berhasil diupdate',
                'data' => $transaksiSensor
            ], $transaksiSensor->wasRecentlyCreated ? 201 : 200);

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
                'error' => 'Terjadi kesalahan saat menyimpan/mengupdate data sensor',
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
