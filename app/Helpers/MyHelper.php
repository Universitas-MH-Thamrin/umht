<?php
namespace App\Helpers;

use App\Models\Cabor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MyHelper {
    public static function get_avatar($avatar, $empty_if_null = false)
    {
        // check existence of the file and is uploaded
        if($avatar != NULL)
        {
            return url(Storage::url($avatar));
        } else {
            if (!$empty_if_null) {
                return asset('img/user.png');
            }
        }
    }

    public static function get_prestasi($avatar, $empty_if_null = false)
    {
        // check existence of the file and is uploaded
        if($avatar != NULL)
        {
            return url(Storage::url($avatar));
        } else {
            if (!$empty_if_null) {
                return asset('img/no-image.jpg');
            }
        }
    }

    public static function readableDate($date)
    {
        return Carbon::parse($date)->locale('id_ID')->isoFormat('D MMMM Y');
    }

    public static function formatNumber($number)
    {
        return number_format($number, 0, ',', '.');
    }

    public static function formatRupiah($number, $nol_menjadi_gratis = true)
    {
        if ($number > 0)
            return "Rp " . self::formatNumber($number);

        if ($number < 0)
            return "Rp " . self::formatNumber($number);

        if ($nol_menjadi_gratis)
            return "<span class='badge badge-success'>Gratis</span>";

        return 0;
    }

    public static function getMonthName($number, $year)
    {
        $indonesianMonths = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        if ($year) {
            return $indonesianMonths[$number] .' '. $year ?? date('Y');
        }
        return $indonesianMonths[$number];
    }


    public static function avatarUser($user, $width="90px")
    {
        if (($user->foto ?? $user->logo) == NULL) {
            return '<span data-letters="'. MyHelper::inisialNama($user->nama ?? $user->name) .'"></span>';
        } else {
            return '<div style="width: '. $width .';height:'. $width .';border-radius: 50%;">
                <img src="'. MyHelper::get_avatar($user->foto ?? $user->logo) .'" alt=""
                class="" style="width:100%;height:100%;object-fit:cover;border-radius: 50%;">
            </div>';
        }
    }

    public static function inisialNama($str) {
        $acronym = '';
        $word = '';
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }

    public static function getPendidikan()
    {
        return [
            'SD' => 'SD',
            'SMP' => 'SMP',
            'SMA' => 'SMA',
            'D3' => 'D3',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S3',
        ];
    }

    public static function getStatusKawin()
    {
        return [
            'Belum Kawin',
            'Kawin',
            'Cerai Hidup',
            'Cerai Mati',
        ];
    }

    public static function getAgama()
    {
        return [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha',
            'Konghucu' => 'Konghucu',
        ];
    }

    public static function getJenisKelamin()
    {
        return [
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan',
        ];
    }

    public static function getTingkat()
    {
        return [
            'Kecamatan' => 'Kecamatan',
            'Kabupaten' => 'Kabupaten',
            'Provinsi' => 'Provinsi',
            'Nasional' => 'Nasional',
            'Internasional' => 'Internasional',
        ];
    }

    public static function getMedali()
    {
        return [
            'Emas' => 'Emas',
            'Perak' => 'Perak',
            'Perunggu' => 'Perunggu',
        ];
    }

    public static function getRole($user)
    {
        if ($user->role == 'admin') {
            return '<span class="badge bg-primary">Admin</span>';
        } else if ($user->role == 'user') {
            return '<span class="badge bg-success">User</span>';
        } else {
            return '<span class="badge bg-info">'. ucwords($user->role) .'</span>';
        }
    }

    public static function getBooleanBadge($bool)
    {
        if ($bool) {
            return '<span class="badge bg-success">Ya</span>';
        } else {
            return '<span class="badge bg-danger">Tidak</span>';
        }
    }

    public static function getBulan()
    {
        return [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }

    public static function getBidang()
    {
        return [
            'industrial' => 'Bid. Hubungan Industrial',
            'penta' => 'Bid. Penempatan Tenaga Kerja',
            'pelatihan' => 'Bid. Pelatihan',
        ];
    }

    public static function getWilayahKerja()
    {
        return [
            'Lintas Provinsi' => 'Lintas Provinsi',
            'Satu Provinsi' => 'Satu Provinsi',
            'Satu Kabupaten/Kota' => 'Satu Kabupaten/Kota',
        ];
    }

    public static function getSifatPekerja()
    {
        return [
            'Darurat/Mendesak' => 'Darurat/Mendesak',
            'Sementara' => 'Sementara',
            'Lebih dari 6 bulan' => 'Lebih dari 6 bulan',
        ];
    }

    public static function get_size($file_path)
    {
        try {
            return number_format(Storage::size($file_path) / 1048576,2) . ' MB';
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function is_image($file)
    {
        $images = array('jpg', 'png', 'jpeg', 'bmp', 'webp');
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (!in_array($ext, $images)) {
            return false; // NOT A IMAGE
        } else {
            return true; // AN IMAGE!
        }
    }

    public static function getSektor()
    {
        return [
            "Pertanian, kehutanan, perburuan dan perikanan",
            "Pertambangan dan penggalian",
            "Industri Pengolahan",
            "Listrik, Gas dan Air",
            "Bangunan",
            "Perdagangan besar dan Hotel",
            "Angkutan",
            "Keuangan, Tanah dan Jasa Perusahaan",
            "Jasa Kemasyarakatan",
            "Kegiatan yang belum jelas batasannya.",
        ];
    }

    public static function getBulanByNumber($num)
    {
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $months[$num];
    }

    public static function getDisabilitas()
    {
        return [
            'Disabilitas Netra',
            'Disabilitas Wicara',
            'Disabilitas Rungu',
            'Disabilitas Rungu dan Wicara',
            'Disabilitas Mental',
            'Disabilitas Fisik',
            'Disabilitas Fisik dan Mental',
            'Tidak',
        ];
    }
}
