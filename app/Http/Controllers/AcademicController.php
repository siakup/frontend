<?php

namespace App\Http\Controllers;

use App\Endpoint\EventAcademicService;
use App\Endpoint\PeriodAcademicService;
use App\Http\Requests\CreateBulkEventAcademicRequest;
use App\Http\Requests\StoreEventAcademicRequest;
use App\Http\Requests\StorePeriodeAcademicRequest;
use App\Http\Requests\UpdateEventAcademicRequest;
use App\Http\Requests\UpdatePeriodeAcademicRequest;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class AcademicController extends Controller
{
    use ApiResponse;

    public function indexPeriode(Request $request)
    {
        try {
            $search = $request->input('search');
            $sort = $request->input('sort', 'created_at,desc');
            $limit = $request->input('limit', 10);
            $page = $request->input('page', 1);

            $params = compact('search', 'sort', 'page', 'limit');

            // $url = PeriodAcademicService::getInstance()->getListAllPeriode();
            // $response = getCurl($url, $params, getHeaders());

            // --- DUMMY DATA START ---
            $response = (object) [
                'success' => true,
                'data' => [
                    (object) [
                        'id' => 1,
                        'tahun' => '2023',
                        'semester' => 3,
                        'is_active' => 1,
                        'tanggal_mulai' => '2023-09-01',
                        'tanggal_selesai' => '2024-01-31',
                    ],
                    (object) [
                        'id' => 2,
                        'tahun' => '2024',
                        'semester' => 2, // 2 = Genap
                        'is_active' => 0,
                        'tanggal_mulai' => '2024-02-01',
                        'tanggal_selesai' => '2024-06-30',
                    ],
                    (object) [
                        'id' => 1,
                        'nama_periode' => '2023/2024 Ganjil',
                        'semester' => 1, // 1 = Ganjil (Sesuai array $namaSemester di bawah)
                        'is_active' => 1,
                        'tanggal_mulai' => '2023-09-01',
                        'tanggal_selesai' => '2024-01-31',
                    ],
                    (object) [
                        'id' => 2,
                        'nama_periode' => '2023/2024 Genap',
                        'semester' => 2, // 2 = Genap
                        'is_active' => 0,
                        'tanggal_mulai' => '2024-02-01',
                        'tanggal_selesai' => '2024-06-30',
                    ],
                    (object) [
                        'id' => 1,
                        'nama_periode' => '2023/2024 Ganjil',
                        'semester' => 1, // 1 = Ganjil (Sesuai array $namaSemester di bawah)
                        'is_active' => 1,
                        'tanggal_mulai' => '2023-09-01',
                        'tanggal_selesai' => '2024-01-31',
                    ],
                    // (object) [
                    //     'id' => 2,
                    //     'nama_periode' => '2023/2024 Genap',
                    //     'semester' => 2, // 2 = Genap
                    //     'is_active' => 0,
                    //     'tanggal_mulai' => '2024-02-01',
                    //     'tanggal_selesai' => '2024-06-30',
                    // ],
                    // (object) [
                    //     'id' => 1,
                    //     'nama_periode' => '2023/2024 Ganjil',
                    //     'semester' => 1, // 1 = Ganjil (Sesuai array $namaSemester di bawah)
                    //     'is_active' => 1,
                    //     'tanggal_mulai' => '2023-09-01',
                    //     'tanggal_selesai' => '2024-01-31',
                    // ],
                    // (object) [
                    //     'id' => 2,
                    //     'nama_periode' => '2023/2024 Genap',
                    //     'semester' => 2, // 2 = Genap
                    //     'is_active' => 0,
                    //     'tanggal_mulai' => '2024-02-01',
                    //     'tanggal_selesai' => '2024-06-30',
                    // ],
                    // (object) [
                    //     'id' => 1,
                    //     'nama_periode' => '2023/2024 Ganjil',
                    //     'semester' => 1, // 1 = Ganjil (Sesuai array $namaSemester di bawah)
                    //     'is_active' => 1,
                    //     'tanggal_mulai' => '2023-09-01',
                    //     'tanggal_selesai' => '2024-01-31',
                    // ],
                    // (object) [
                    //     'id' => 2,
                    //     'nama_periode' => '2023/2024 Genap',
                    //     'semester' => 2, // 2 = Genap
                    //     'is_active' => 0,
                    //     'tanggal_mulai' => '2024-02-01',
                    //     'tanggal_selesai' => '2024-06-30',
                    // ],
                    // (object) [
                    //     'id' => 1,
                    //     'nama_periode' => '2023/2024 Ganjil',
                    //     'semester' => 1, // 1 = Ganjil (Sesuai array $namaSemester di bawah)
                    //     'is_active' => 1,
                    //     'tanggal_mulai' => '2023-09-01',
                    //     'tanggal_selesai' => '2024-01-31',
                    // ],
                    // (object) [
                    //     'id' => 2,
                    //     'nama_periode' => '2023/2024 Genap',
                    //     'semester' => 2, // 2 = Genap
                    //     'is_active' => 0,
                    //     'tanggal_mulai' => '2024-02-01',
                    //     'tanggal_selesai' => '2024-06-30',
                    // ],
                ],
                'pagination' => (object) [
                    'current_page' => 1,
                    'from' => 1,
                    'total' => 2,
                    'per_page' => 10,
                ]
            ];
            // --- DUMMY DATA END ---

            $pagination = [
              'currentPage' => $response->pagination->current_page,
              'from' => $response->pagination->from,
              'last' => ceil($response->pagination->total / $response->pagination->per_page),
              'limit' => $limit
            ];

            if (! isset($response->success) || ! $response->success) {
                // throw new \Exception($response);
            }

            if ($request->ajax()) {
                return $this->successResponse(['periode' => $response->data, 'pagination' => $pagination], 'Berhasil mendapatkan data');
            }

            $namaSemester = [
                1 => 'Ganjil',
                2 => 'Genap',
                3 => 'Pendek',
            ];

            return view('academics.periode.index', [
                'data' => $response,
                'search' => $search,
                'sort' => $sort,
                'page' => $page,
                'limit' => $limit,
                'namaSemester' => $namaSemester,
                'pagination' => $pagination
            ]);
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal mengambil data Periode Akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal mengambil Data periode akademik');
            }

            dd($err);
            // return redirect()
            //     ->route('home')
            //     ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman periode akademik']);
        }
    }

    public function periodeDetail(Request $request)
    {
        try {
            $id = $request->input('id');
            $url = PeriodAcademicService::getInstance()->periodeUrl($id);
            $response = getCurl($url, null, getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            $data = $response->data->periode;
            if ($request->ajax()) {
                return view('academics.periode._modal-view', get_defined_vars())->render();
            }

            throw new \Exception(json_encode([
                'message' => 'Request tidak valid',
                'system_error' => null,
            ]));

            return redirect()->route('academics-periode.index');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat modal detail periode akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal memuat modal detail periode akademik');
            }

            return redirect()
                ->route('academics-periode.index')
                ->withErrors(['error' => $decoded->message ?? 'Gagal memuat modal detail periode akademik']);
        }
    }

    public function createPeriode(Request $request)
    {
        return view('academics.periode.create', get_defined_vars());
    }

    public function periodeStore(StorePeriodeAcademicRequest $request)
    {
        try {
            $url = PeriodAcademicService::getInstance()->store();
            $response = postCurl($url, $request->all(), getHeaders());

            if (! isset($response->success) && ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
            }

            return redirect()->route('academics-periode.index')->with('success', 'Berhasil disimpan');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal menyimpan data periode akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $decoded->message ?? 'Gagal menyimpan data'], 422);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan data periode akademik']);
        }
    }

    public function periodeDelete(Request $request, $id)
    {
        try {
            $url = PeriodAcademicService::getInstance()->periodUrl($id);
            $response = deleteCurl($url, getHeaders());
            if (! isset($response->success) || ! $response->success) {
                throw new \Exception($response);
            }

            if ($request->ajax()) {
                return $response;
            }

            return redirect()->route('academics-periode.index')->with('success', 'Data periode akademik berhasil dihapus.');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal menghapus data periode akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $decoded->message ?? 'Gagal menghapus data periode akademik'], 422);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => $decoded->message ?? 'Gagal menghapus data periode akademik']);
        }
    }

    public function periodeEdit(Request $request, $id)
    {
        try {
            if ($request->ajax) {
                throw new \Exception(json_encode([
                    'message' => 'Request tidak valid',
                    'system_error' => null,
                ]));
            }

            $url = PeriodAcademicService::getInstance()->periodeUrl($id);
            $response = getCurl($url, null, getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception($response);
            }

            $data = json_decode(json_encode($response), true)['data']['periode'];

            return view('academics.periode.edit', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal mendapatkan detail data periode akademik untuk diubah', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $decoded->message ?? 'Request tidak valid'], 422);
            }

            return redirect()
                ->route('academics-periode.index')
                ->withErrors(['error' => $decoded->message ?? 'Gagal mendapatkan detail data periode akademik untuk diubah']);
        }
    }

    public function periodeUpdate(UpdatePeriodeAcademicRequest $request, $id)
    {
        try {
            $url = PeriodAcademicService::getInstance()->periodeUrl($id);
            $response = putCurl($url, $request->all(), getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return $this->successResponse($response->data ?? [], 'Periode berhasil diperbarui');
            }

            return redirect()->route('academics-periode.index')->with('success', 'Periode berhasil diperbarui');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal mengubah data periode akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $decoded->message ?? 'Gagal mengubah data periode akademik'], 422);
            }

            return redirect()
                ->back()
                ->withErrors(['error' => $decoded->message ?? 'Gagal mengubah data periode akademik']);
        }
    }

    public function indexEvent(Request $request)
    {
        try {
            $search = $request->input('search');
            $sort = $request->input('sort', 'created_at,desc');
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);

            $params = [
                'search' => $search,
                'page' => $page,
                'sort' => $sort,
                'limit' => $limit,
            ];

            $url = EventAcademicService::getInstance()->baseEventURL();
            $response = getCurl($url, $params, getHeaders());
            $data = json_decode(json_encode($response), true);

            if (! isset($response->success) || ! $response->success) {
                throw new Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
            }

            return view('academics.event.index', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            if ($request->ajax()) {
                Log::error('Gagal mendapatkan data event akademik', [
                    'url' => $url ?? null,
                    'request_data' => $request->all(),
                    'response' => $decoded,
                ]);

                return $this->errorResponse($decoded->message);
            } else {
                Log::error('Gagal memuat halaman event akademik', [
                    'url' => $url ?? null,
                    'request_data' => $request->all(),
                    'response' => $decoded,
                ]);

                return redirect()->route('home')->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman event akademik']);
            }
        }
    }

    public function eventDetail(Request $request)
    {
        try {
            $id = $request->input('id');
            $url = EventAcademicService::getInstance()->eventUrl($id);
            $response = getCurl($url, null, getHeaders());
            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }
            $data = $response->data->event;

            if ($request->ajax()) {
                return view('academics.event._modal-view', get_defined_vars())->render();
            }

            throw new \Exception(json_encode([
                'message' => 'Request tidak valid',
                'system_error' => null,
            ]));
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat detail event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal memuat detail event akademik');
            } else {
                return redirect()->route('home')->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman detail event akademik: Request tidak valid']);
            }
        }
    }

    public function eventEdit(Request $request, $id)
    {
        try {
            $url = EventAcademicService::getInstance()->eventUrl($id);
            $response = getCurl($url, null, getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                throw new \Exception(json_encode([
                    'message' => 'Request tidak valid',
                    'system_error' => null,
                ]));
            }

            $data = json_decode(json_encode($response), true)['data']['event'];

            return view('academics.event.edit', get_defined_vars());
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman edit event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if (! $request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal memuat halaman edit event akademik');
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman edit event akademik: Request tidak valid']);
            }
        }
    }

    public function eventUpdate(UpdateEventAcademicRequest $request, $id)
    {
        try {
            $url = EventAcademicService::getInstance()->eventUrl($id);
            $response = putCurl($url, $request->all(), getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return $this->successResponse($response->data ?? [], 'Berhasil disimpan');
            }

            return redirect()->route('academics-event.index')->with('success', 'Berhasil disimpan');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal memuat halaman edit event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal memuat halaman edit event akademik');
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman edit event akademik: Request tidak valid']);
            }
        }
    }

    public function eventDelete(Request $request, $id)
    {
        try {
            $url = EventAcademicService::getInstance()->eventUrl($id);
            $response = deleteCurl($url, getHeaders());
            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return $response;
            }

            return redirect()->route('academics-event.index')->with('success', 'Berhasil dihapus');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal gagal menghapus data event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return $this->errorResponse($decoded->message ?? 'Gagal menghapus data event akademik');
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['error' => $decoded->message ?? 'Gagal menghapus data event akademik: Request tidak valid']);
            }
        }
    }

    public function eventCreate(Request $request)
    {
        return view('academics.event.create', get_defined_vars());
    }

    public function eventStore(StoreEventAcademicRequest $request)
    {
        try {
            $url = EventAcademicService::getInstance()->baseEventURL();
            $response = postCurl($url, $request->all(), getHeaders());

            if (! isset($response->success) || ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Berhasil disimpan']);
            }

            return redirect()->route('academics-event.index')->with('success', 'Berhasil disimpan');
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal menambahkan data event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal menyimpan data'], 422);
            } else {
                return redirect()->back()->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan data event akademik']);
            }
        }
    }

    public function eventUpload(Request $request)
    {
        return view('academics.event.upload', get_defined_vars());
    }

    public function eventDownloadTemplate(Request $request)
    {
        try {
            $type = $request->query('type', 'xlsx');
            $allowed = ['xlsx', 'csv'];

            if (! in_array($type, $allowed)) {
                throw new \Exception(json_encode([
                    'message' => 'Format file tidak valid',
                    'system_error' => $request->all(),
                ]));
            }

            $data = [
                ['nama', 'event nilai', 'event irs', 'event kelulusan', 'event registrasi', 'event yudisium', 'event survei', 'event dosen', 'status'],
                ['', 'y/n', 'y/n', 'y/n', 'y/n', 'y/n', 'y/n', 'y/n', 'active/inactive'],
            ];

            $filename = 'template-event-akademik.'.$type;

            if (! $request->ajax()) {
                return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray, \Maatwebsite\Excel\Concerns\WithHeadings
                {
                    private $rows;

                    public function __construct($rows)
                    {
                        $this->rows = $rows;
                    }

                    public function array(): array
                    {
                        return array_slice($this->rows, 1);
                    }

                    public function headings(): array
                    {
                        return $this->rows[0];
                    }
                }, $filename, $type === 'csv' ? ExcelFormat::CSV : ExcelFormat::XLSX);
            }

            throw new \Exception(json_encode([
                'message' => 'Request tidak valid',
                'system_error' => $request->all(),
            ]));
        } catch (\Throwable $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal mengunduh data event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal mengunduh template event akademik'], 422);
            } else {
                return redirect()->back()->withErrors(['error' => $decoded->message ?? 'Gagal mengunduh template event akademik']);
            }
        }
    }

    public function eventPreview(Request $request)
    {
        try {
            $file = $request->file('file');

            if (! $file) {
                throw new \Exception('File belum diupload!');
            }
            if (! $file->isValid()) {
                throw new \Exception('File upload tidak valid!');
            }
            if ($file->getSize() === 0) {
                throw new \Exception('File yang diupload tidak terisi!');
            }

            $allowedExtensions = ['xlsx', 'xls', 'csv'];
            $extension = strtolower($file->getClientOriginalExtension());

            if (! in_array($extension, $allowedExtensions)) {
                throw new \Exception('Ekstensi file tidak valid. Harap upload file berformat: .xlsx, .xls, atau .csv');
            }

            $allowedMimes = [
                'text/csv',
                'text/plain',
                'application/csv',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            $mimeType = $file->getMimeType();
            if (! in_array($mimeType, $allowedMimes)) {
                throw new \Exception("Tipe file tidak valid ($mimeType). Harap upload file Excel atau CSV yang benar.");
            }

            $maxSize = 5 * 1024 * 1024;
            if ($file->getSize() > $maxSize) {
                throw new \Exception('Ukuran file terlalu besar. Maksimal 5MB.');
            }

            $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $file);
            $datas = $rows[0] ?? [];

            if (empty($datas)) {
                throw new \Exception('File yang diupload kosong!');
            }

            $keyData = $datas[0];
            $valueData = array_slice($datas, 1);

            if (empty($valueData)) {
                throw new \Exception('File yang diupload kosong!');
            }

            $datas = array_values(array_filter(
                array_map(
                    function ($data) use ($keyData) {
                        $findNull = current(array_filter($data, function ($d) {
                            return $d == null;
                        }));
                        if ($findNull !== null) {
                            return array_combine($keyData, $data);
                        } else {
                            return [];
                        }
                    },
                    $valueData
                ),
                fn ($data) => ! empty($data)
            ));

            if (count($datas) === 0) {
                throw new \Exception('File yang diupload memiliki data yang tidak valid pada seluruh barisnya!');
            }

            return view('academics.event.preview', get_defined_vars());
        } catch (\Exception $err) {
            Log::error('Gagal membaca file kalender akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $err->getMessage() ?? 'Gagal membaca file',
                'exception' => $err,
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => $err->getMessage() ?? 'Gagal membaca file'])
                ->withInput();
        }
    }

    public function eventStoreUpload(CreateBulkEventAcademicRequest $request)
    {
        try {
            $url = EventAcademicService::getInstance()->bulkStore();
            $response = postCurl($url, ['events' => $request->data], getHeaders());
            if (! isset($response->success) && ! $response->success) {
                throw new \Exception(json_encode($response));
            }

            if ($request->ajax) {
                return response()->json(['success' => true, 'message' => 'Berhasil menggunggah event akademik']);
            }

            return redirect()->route('academics-event.index')->with('success', 'Berhasil mengunggah event akademik');
        } catch (\Exception $err) {
            $decoded = json_decode($err->getMessage());

            Log::error('Gagal menyimpan multi data event akademik', [
                'url' => $url ?? null,
                'request_data' => $request->all(),
                'response' => $decoded,
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $response->message ?? 'Gagal membaca file'], 422);
            }

            return redirect()
                ->route('academics-event.index')
                ->withErrors(['error' => $err->getMessage() ?? 'Gagal membaca file'])
                ->withInput();
        }
    }
}
