<?php

namespace App\Enums;

enum ServiceStatus:int
{
    case DITERIMA = 1;
    case DIAGNOSA = 2;
    case PERSIAPAN = 3;
    case PROSES = 4;
    case LANGKAH_AKHIR = 5;
    case SELESAI  = 6;
}

//agar codingan yang di controller bisa lebih
//mudah dibaca:) karna di db pake int yang servicestatus