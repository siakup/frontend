<?php
namespace App\Http\Controllers;

use App\Endpoint\CurriculumService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


use App\Traits\ApiResponse;
use App\Endpoint\EventCalendarService;

use Exception;
use Svg\Tag\Rect;

class CurriculumController extends Controller
{
    use ApiResponse;

    public function curriculumList(Request $request) 
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');
      
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);
      
      $url = CurriculumService::getInstance()->listCurriculum();
      $response = getCurl($url, null, getHeaders());
      $data = $response->data;
      // dd($data);
      return view('curriculums.list.index', get_defined_vars());
    }

    public function createCurriculumList(Request $request)
    {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);

      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $jenis_mata_kuliah = [
        [
          'nama' => 'Mata Kuliah Dasar Teknik',
        ],
        [
          'nama' => 'Mata Kuliah Dasar Umum',
        ],
        [
          'nama' => 'Mata Kuliah Program Studi',
        ],
        [
          'nama' => 'Mata Kuliah Sains Dasar',
        ],
        [
          'nama' => 'Mata Kuliah Universitas Pertamina',
        ],
      ];

      return view('curriculums.list.create', get_defined_vars());
    }

    public function storeCurriculumList(Request $request) 
    {
      return redirect()->route('curriculum.list.edit', ['id' => 1])->with('success', 'Tambah Kurikulum Berhasil Disimpan');
    }

    public function updateCurriculumList(Request $request, $id)
    {
      return redirect()->route('curriculum.list.edit', ['id' => $id])->with('success', 'Berhasil Disimpan');
    }

    public function editCurriculumList(Request $request, $id)
    {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);

      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $jenis_mata_kuliah = [
        [
          'nama' => 'Mata Kuliah Dasar Teknik',
        ],
        [
          'nama' => 'Mata Kuliah Dasar Umum',
        ],
        [
          'nama' => 'Mata Kuliah Program Studi',
        ],
        [
          'nama' => 'Mata Kuliah Sains Dasar',
        ],
        [
          'nama' => 'Mata Kuliah Universitas Pertamina',
        ],
      ];

      $data = [
        "program_studi" => "Teknik Kimia",
        "program_perkuliahan" => "Reguler",
        "curriculum_nama" => "Kurikulum 2025 - Teknik Kimia",
        "deskripsi" => "Kurikulum Tahun 2025",
        "sks_wajib" => "100",
        "sks_pilihan" => "44",
        "total_sks" => "144",
        "status" => "active",
        "mata_kuliah_dasar_teknik" => 40,
        "mata_kuliah_dasar_umum" => 40,
        "mata_kuliah_program_studi" => 20,
        "mata_kuliah_sains_dasar" => 20,
        "mata_kuliah_universitas_pertamina" => 24
      ];

      $assignCourseData = [
        [
          'id' => 1,
          'kode_mata_kuliah' => 'UP0011',
          'nama' => 'Agama dan Etika',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 2,
          'kode_mata_kuliah' => '10004',
          'nama' => 'Agama Katolik dan Etika',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 3,
          'kode_mata_kuliah' => '52204',
          'nama' => 'Aljabar Linear dan Aplikasinya',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 4,
          'kode_mata_kuliah' => '52294',
          'nama' => 'Algoritma dan Struktur Data',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 5,
          'kode_mata_kuliah' => '10101',
          'nama' => 'Bahasa Indonesia',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 6,
          'kode_mata_kuliah' => '21033',
          'nama' => 'Aplikasi dan Teknologi EBT',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 7,
          'kode_mata_kuliah' => 'UP1103',
          'nama' => 'Bahasa Inggris I ',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 8,
          'kode_mata_kuliah' => 'UP1203',
          'nama' => 'Bahasa Inggris II',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ]
      ];

      return view('curriculums.list.edit', get_defined_vars());
    }

    public function viewCurriculumList(Request $request, $id)
    {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);

      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
  
      $id_program = $request->input('program_perkuliahan');

      $jenis_mata_kuliah = [
        [
          'nama' => 'Mata Kuliah Dasar Teknik',
        ],
        [
          'nama' => 'Mata Kuliah Dasar Umum',
        ],
        [
          'nama' => 'Mata Kuliah Program Studi',
        ],
        [
          'nama' => 'Mata Kuliah Sains Dasar',
        ],
        [
          'nama' => 'Mata Kuliah Universitas Pertamina',
        ],
      ];

      $data = [
        "program_studi" => "Teknik Kimia",
        "program_perkuliahan" => "Reguler",
        "curriculum_nama" => "Kurikulum 2025 - Teknik Kimia",
        "deskripsi" => "Kurikulum Tahun 2025",
        "sks_wajib" => "100",
        "sks_pilihan" => "44",
        "total_sks" => "144",
        "status" => "active",
        "mata_kuliah_dasar_teknik" => 40,
        "mata_kuliah_dasar_umum" => 40,
        "mata_kuliah_program_studi" => 20,
        "mata_kuliah_sains_dasar" => 20,
        "mata_kuliah_universitas_pertamina" => 24
      ];

      return view('curriculums.list.view', get_defined_vars());
    }

    public function showCurriculumStudyList(Request $request, $id) {
      $jenis_mata_kuliah = $request->input('jenis_mata_kuliah', '');
      $nama_mata_kuliah = $request->input('nama', '');
      $data = [
        [
          'id' => 1,
          'kode_mata_kuliah' => 'UP0011',
          'nama' => 'Agama dan Etika',
          'sks' => 2,
          'semester' => 8,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 2,
          'kode_mata_kuliah' => '10004',
          'nama' => 'Agama Katolik dan Etika',
          'sks' => 2,
          'semester' => 1,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 3,
          'kode_mata_kuliah' => '52204',
          'nama' => 'Aljabar Linear dan Aplikasinya',
          'sks' => 3,
          'semester' => 8,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 4,
          'kode_mata_kuliah' => '52294',
          'nama' => 'Algoritma dan Struktur Data',
          'sks' => 3,
          'semester' => 8,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 5,
          'kode_mata_kuliah' => '10101',
          'nama' => 'Bahasa Indonesia',
          'sks' => 2,
          'semester' => 1,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 6,
          'kode_mata_kuliah' => '21033',
          'nama' => 'Aplikasi dan Teknologi EBT',
          'sks' => 3,
          'semester' => 8,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 7,
          'kode_mata_kuliah' => 'UP1103',
          'nama' => 'Bahasa Inggris I ',
          'sks' => 2,
          'semester' => 2,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 8,
          'kode_mata_kuliah' => 'UP1203',
          'nama' => 'Bahasa Inggris II',
          'sks' => 2,
          'semester' => 2,
          'jumlah_cpl' => 0,
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ]
      ];

      return view('curriculums.list.show-course', get_defined_vars());
    }

    public function updateAssignCurriculumCourse(Request $request, $id)
    {
      return redirect()->route('curriculum.list.edit', ['id' => $id])->with('success', 'Mata Kuliah Berhasil ditetapkan');
    }

    public function assignCurriculumCourse(Request $request, $id) 
    {
      $jenis_mata_kuliah = $request->input('jenis_mata_kuliah', '');
      $nama_mata_kuliah = $request->input('nama');
      $data = [
        [
          'id' => 1,
          'kode_mata_kuliah' => 'UP0011',
          'nama' => 'Agama dan Etika',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 2,
          'kode_mata_kuliah' => '10004',
          'nama' => 'Agama Katolik dan Etika',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Dasar Umum'
        ],
        [
          'id' => 3,
          'kode_mata_kuliah' => '52204',
          'nama' => 'Aljabar Linear dan Aplikasinya',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 4,
          'kode_mata_kuliah' => '52294',
          'nama' => 'Algoritma dan Struktur Data',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 5,
          'kode_mata_kuliah' => '10101',
          'nama' => 'Bahasa Indonesia',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 6,
          'kode_mata_kuliah' => '21033',
          'nama' => 'Aplikasi dan Teknologi EBT',
          'sks' => 3,
          'program_studi' => 'Ilmu Komputer',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 7,
          'kode_mata_kuliah' => 'UP1103',
          'nama' => 'Bahasa Inggris I ',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ],
        [
          'id' => 8,
          'kode_mata_kuliah' => 'UP1203',
          'nama' => 'Bahasa Inggris II',
          'sks' => 2,
          'program_studi' => 'Komunikasi',
          'jenis_mata_kuliah' => 'Mata Kuliah Program Studi'
        ]
      ];
      
      return view('curriculums.list.assign-course', get_defined_vars());
    }

    public function editCurriculumStudyList(Request $request, $id, $course_id) 
    {
      dd($id);
    }

    public function curriculumEquivalence(Request $request) 
    {
      $urlProgramStudi = EventCalendarService::getInstance()->getListStudyProgram();
      $responseProgramStudiList = getCurl($urlProgramStudi, null, getHeaders());
      $programStudiList = $responseProgramStudiList->data;
      $id_prodi = $request->input('program_studi', $programStudiList[0]->id);

      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $data = [
        [
          'kode_lama' => 'CH1101',
          'matkul_kurikulum_lama' => 'Kimia Dasar I',
          'sks_lama' => 3,
          'kode_baru' => null,
          'matkul_kurikulum_baru' => null,
          'sks_baru' => null,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CH1202',
          'matkul_kurikulum_lama' => 'Kimia Dasar II',
          'sks_lama' => 3,
          'kode_baru' => null,
          'matkul_kurikulum_baru' => null,
          'sks_baru' => null,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CO0011',
          'matkul_kurikulum_lama' => 'Persiapan Memasuki Dunia Kerja dan Etika Profesi',
          'sks_lama' => 2,
          'kode_baru' => 52042,
          'matkul_kurikulum_baru' => 'Persiapan Memasuki Dunia Kerja dan Etika Profesi',
          'sks_baru' => 2,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0012',
          'matkul_kurikulum_lama' => 'Pengantar Teknologi Informasi dan Algoritma',
          'sks_lama' => 2,
          'kode_baru' => 52102,
          'matkul_kurikulum_baru' => 'Berpikir Komputasi',
          'sks_baru' => 2,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0032',
          'matkul_kurikulum_lama' => 'Pemrograman Perangkat Bergerak',
          'sks_lama' => 3,
          'kode_baru' => 52310,
          'matkul_kurikulum_baru' => 'Pemrograman Perangkat Bergerak',
          'sks_baru' => 3,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0035',
          'matkul_kurikulum_lama' => 'Penggalian Data',
          'sks_lama' => 3,
          'kode_baru' => 52305,
          'matkul_kurikulum_baru' => 'Pengantar Sains Data',
          'sks_baru' => 3,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0037',
          'matkul_kurikulum_lama' => 'Mesin Pembelajaran',
          'sks_lama' => 3,
          'kode_baru' => 52312,
          'matkul_kurikulum_baru' => 'Praktikum Pembelajaran Mesin',
          'sks_baru' => 1,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0035',
          'matkul_kurikulum_lama' => 'Mesin Pembelajaran',
          'sks_lama' => 3,
          'kode_baru' => 52311,
          'matkul_kurikulum_baru' => 'Pembelajaran Mesin',
          'sks_baru' => 3,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0041',
          'matkul_kurikulum_lama' => 'Perencanaan Sumber Daya Perusahaan',
          'sks_lama' => 3,
          'kode_baru' => 10008,
          'matkul_kurikulum_baru' => 'Inovasi dan Kewirausahaan',
          'sks_baru' => 2,
          'program_studi' => 'Ilmu Komputer',
        ],
        [
          'kode_lama' => 'CS0043',
          'matkul_kurikulum_lama' => 'Teknologi E-Bussiness dan Industri Kreatif TIK',
          'sks_lama' => 3,
          'kode_baru' => 10008,
          'matkul_kurikulum_baru' => 'Inovasi dan Kewirausahaan',
          'sks_baru' => 2,
          'program_studi' => 'Ilmu Komputer',
        ],
      ];
      return view('curriculums.equivalence.index', get_defined_vars());
    }

    public function requiredCurriculumStructure(Request $request) 
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $data = [
        [
          'semester' => 1,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 2,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 3,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 4,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 5,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 6,
          'total_sks' => 15,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
          ]
        ],
      ];
      return view('curriculums.structure.required', get_defined_vars());
    }

    public function optionalCurriculumStructure(Request $request) 
    {
      $urlProgramPerkuliahan = EventCalendarService::getInstance()->getListUniversityProgram();
      $responseProgramPerkuliahanList = getCurl($urlProgramPerkuliahan, null, getHeaders());
      $programPerkuliahanList = $responseProgramPerkuliahanList->data;
      $id_program = $request->input('program_perkuliahan');

      $data = [
        [
          'semester' => 1,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 2,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 3,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 4,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 5,
          'total_sks' => 24,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Diplomasi',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Organisasi Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Penulisan Akademik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'PPSMB',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ]
          ]
        ],
        [
          'semester' => 6,
          'total_sks' => 15,
          'matkul_list' => [
            [
              'nama_matkul' => 'Ilmu Sosial Dasar',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Politik',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sejarah Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Sistem Sosial Politik Indonesia',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
            [
              'nama_matkul' => 'Pengantar Ilmu Hubungan Internasional',
              'sks' => 3,
              'kode' => 'SPFA212100'
            ],
          ]
        ],
      ];
      return view('curriculums.structure.optional', get_defined_vars());
    }

    public function index(Request $request)
    {
      return view('study.index', get_defined_vars());
    }

    public function create(Request $request)
    {
      return view('study.create', get_defined_vars());
    }

    public function edit(Request $request, $id)
    {
      return view('study.edit', get_defined_vars());
    }

    public function view(Request $request, $id)
    {
      return view('study.view', get_defined_vars());
    }

    public function store(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Berhasil disimpan');
    }

    public function send(Request $request, $id) 
    {
      return redirect()->route('calendar.show', ['id' => $id])->with('success', 'Unggah Event Kalender Akademik telah berhasil');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request, $id)
    {
        return redirect()->back();
    }
}