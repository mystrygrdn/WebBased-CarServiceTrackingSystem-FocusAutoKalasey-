@extends('layouts.customer')

@section('title', 'Service Tracking')

@section('content')

<style>
/* ===== PHOTO ===== */
.photo-container {
    max-width: 100%;
    max-height: 550px;
    border-radius: 12px;
    overflow: hidden;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.photo-container img {
    width: 100%;
    height: 100%;
    max-height: 550px;
    object-fit: contain;
}

/* ===== STEPPER BOX ===== */
.stepper-box {
    background: #ffffff;
    border-radius: 16px;
    padding: 28px;
    border: 1px solid #ebebeb;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
}

/* ===== STEP ===== */
.stepper-step {
    display: flex;
    position: relative;
    padding-bottom: 26px;
}

.stepper-step:last-child {
    padding-bottom: 0;
}

/* ===== LINE ===== */
.stepper-line {
    position: absolute;
    left: 19px;
    top: 42px;
    bottom: 0;
    width: 2px;
    background: #e5e7eb;
    z-index: 1;
}

.stepper-completed>.stepper-line {
    background: linear-gradient(to bottom, #10b981, #6ee7b7);
}

/* ===== CIRCLE ===== */
.stepper-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 14px;
    z-index: 2;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.stepper-completed .stepper-circle {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.30);
}

.stepper-active .stepper-circle {
    border: 2.5px solid #3b82f6;
    color: #3b82f6;
    background: #eff6ff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
}

.stepper-pending .stepper-circle {
    border: 2px solid #e5e7eb;
    color: #d1d5db;
    background: #f9fafb;
}

/* ===== CONTENT ===== */
.stepper-content {
    flex: 1;
    padding-top: 6px;
    min-width: 0;
}

.stepper-title {
    font-weight: 700;
    font-size: 14px;
    color: #111827;
    margin-bottom: 6px;
}

.stepper-pending .stepper-title {
    color: #9ca3af;
    font-weight: 500;
}

/* ===== BADGE ===== */
.stepper-status {
    font-size: 11px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 12px;
    /* match chip height */
    border-radius: 20px;
    font-weight: 700;
    letter-spacing: 0.2px;
    line-height: 1;
    /* ← add this */
}

.stepper-completed .stepper-status {
    background: #d1fae5;
    color: #065f46;
}

.stepper-active .stepper-status {
    background: #dbeafe;
    color: #1d4ed8;
}

.stepper-pending .stepper-status {
    background: #f3f4f6;
    color: #9ca3af;
}

/* ===== TIMESTAMP CHIP ===== */
.stepper-timestamp {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 500;
    padding: 4px 10px;
    /* match badge height */
    border-radius: 20px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    color: #6b7280;
    margin-top: 0;
    /* ← remove the margin-top */
    line-height: 1;
    /* ← add this */
}

.stepper-completed .stepper-timestamp {
    background: #f0fdf4;
    border-color: #bbf7d0;
    color: #16a34a;
}

.stepper-active .stepper-timestamp {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #2563eb;
}

/* ===== DETAIL CARD ===== */
.detail-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #ebebeb;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
}

.detail-card h4 {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 4px;
}

.detail-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 16px;
}

.meta-small {
    font-size: 13px;
    color: #9ca3af;
}

.meta-small strong {
    color: #3b82f6;
    font-weight: 600;
}

/* ===== TABLE ===== */
.table-borderless {
    margin-top: 20px;
}

.table-borderless td {
    padding: 12px 0;
    border: none;
    font-size: 14px;
}

.table-borderless td:first-child {
    width: 40%;
    color: #6b7280;
    font-weight: 500;
}

.table-borderless td:last-child {
    color: #1f2937;
    font-weight: 600;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {

    .photo-container,
    .photo-container img {
        max-height: 320px;
    }

    .detail-card {
        padding: 20px;
    }

    .stepper-box {
        padding: 20px;
    }

    .table-borderless td:first-child {
        width: 45%;
    }
}

@media (max-width: 576px) {

    .photo-container,
    .photo-container img {
        max-height: 280px;
    }

    .detail-card {
        padding: 16px;
    }

    .detail-card h4 {
        font-size: 18px;
    }

    .stepper-box {
        padding: 16px;
    }

    .stepper-circle {
        width: 36px;
        height: 36px;
        font-size: 13px;
    }

    .stepper-title {
        font-size: 13px;
    }

    .table-borderless td {
        padding: 10px 0;
        font-size: 13px;
    }

    .table-borderless td:first-child {
        width: 50%;
    }
}
</style>

<div class="container-fluid">

    @if(!$service)
    <div class="alert alert-warning text-center"
        style="border-radius: 12px; border: 1px solid #fef3c7; background: #fef9c3;">
        <strong>Belum ada data service</strong><br>
        Silakan hubungi admin bengkel.
    </div>
    @else

    <div class="row">

        {{-- ===== LEFT ===== --}}
        <div class="col-lg-8 mb-4">
            <div class="detail-card">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <input type="hidden" id="currentStatusValue" value="{{ $service->status }}">
                        <input type="hidden" id="currentUpdatedAt"
                            value="{{ $service->updated_at->format('Y-m-d H:i:s') }}">
                        <h4>Detail Service</h4>
                        <div class="meta-small">Status: <strong id="serviceStatus">{{ $service->status }}</strong></div>
                    </div>
                    <div class="meta-small text-right">
                        No. Service:<br>
                        <strong style="color:#1f2937;font-size:14px;">{{ $service->no_service }}</strong>
                    </div>
                </div>

                <hr style="border-color:#ebebeb;margin:20px 0;">

                {{-- FOTO --}}
                <input type="hidden" id="currentPhotoValue"
                    value="{{ $service->photo_url ? asset('storage/'.$service->photo_url) : '' }}">
                <div class="mb-4">
                    <h5>Bukti Foto Pengerjaan</h5>
                    @if($service->photo_url)
                    <div class="photo-container">
                        <img src="{{ asset('storage/'.$service->photo_url) }}" alt="Foto Pengerjaan">
                    </div>
                    @else
                    <div class="photo-container" style="height:250px;">
                        <div class="text-center" style="color:#9ca3af;">
                            <i class="fas fa-camera fa-3x mb-3"></i>
                            <div>Belum ada foto pengerjaan</div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- INFO TABLE --}}
                <h5 style="margin-top:32px;">Informasi Service</h5>
                <table class="table table-borderless">
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>{{ $service->customer->nama }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Polisi</td>
                        <td>{{ $service->vehicle->nomor_polisi }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>{{ $service->tanggal_masuk }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Service</td>
                        <td>{{ $service->jenis_service ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Catatan</td>
                        <td>{{ $service->notes ?? '-' }}</td>
                    </tr>
                </table>

            </div>
        </div>

        {{-- ===== RIGHT (STEPPER) ===== --}}
        <div class="col-lg-4 mb-4">
            <div class="stepper-box">

                <strong style="font-size:16px;color:#111827;">Progress Pengerjaan</strong>

                <div style="margin-top:6px;margin-bottom:24px;">
                    <small id="updateTime" class="d-block" style="font-size:12px;color:#9ca3af;">
                        Update: {{ $service->updated_at->format('d M Y, H:i') }}
                    </small>
                    @if($service->estimated_date)
                    <small class="d-block" style="font-size:12px;color:#9ca3af;">
                        Estimasi: {{ \Carbon\Carbon::parse($service->estimated_date)->format('d M Y') }}
                    </small>
                    @endif
                </div>

                @php
                $steps = [
                1 => 'Diterima di Bengkel',
                2 => 'Diagnosa Kerusakan',
                3 => 'Persiapan Service',
                4 => 'Proses Pengerjaan',
                5 => 'Langkah Akhir',
                6 => 'Selesai',
                ];
                @endphp

                @foreach($steps as $num => $label)
                @php
                $isCompleted = ($service->status == 6) || ($service->status > $num);
                $isActive = ($service->status == $num);
                $stepTs = $service->status_timestamps[$num] ?? null;
                $stateClass = $isCompleted ? 'stepper-completed' : ($isActive ? 'stepper-active' : 'stepper-pending');
                @endphp

                <div class="stepper-step {{ $stateClass }}" data-step="{{ $num }}">

                    {{-- LINE --}}
                    @if($num < 6)<div class="stepper-line">
                </div>@endif

                {{-- CIRCLE --}}
                <div class="stepper-circle">
                    @if($isCompleted)
                    <svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
                        <path
                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                    </svg>
                    @else
                    {{ $num }}
                    @endif
                </div>

                {{-- CONTENT --}}
                <div class="stepper-content">
                    <div class="stepper-title">{{ $label }}</div>

                    <div class="d-flex align-items-center flex-wrap" style="gap: 6px; margin-top: 4px;">

                        {{-- STATUS BADGE --}}
                        <span class="stepper-status" data-step-status="{{ $num }}">
                            @if($isCompleted) ✓ Completed
                            @elseif($isActive) ● In Progress
                            @else Pending
                            @endif
                        </span>

                        {{-- TIMESTAMP CHIP (only if exists) --}}
                        @if($stepTs)
                        <span class="stepper-timestamp" data-step-time="{{ $num }}">
                            🕐 {{ \Carbon\Carbon::parse($stepTs)->format('d M Y, H:i') }}
                        </span>
                        @else
                        <span class="stepper-timestamp" data-step-time="{{ $num }}" style="display:none;"></span>
                        @endif

                    </div>
                </div>

            </div>
            @endforeach

        </div>
    </div>

</div>
@endif

</div>

<!-- Modal -->
<div class="modal fade" id="statusChangedModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 20px 60px rgba(0,0,0,0.15);">
            <div class="modal-header bg-success text-white" style="border-radius:16px 16px 0 0;border:none;">
                <h5 class="modal-title">🔔 Status Updated</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="padding:24px;">
                <p id="statusMessage" style="margin:0;font-size:15px;line-height:1.6;">
                    Status service kendaraan Anda telah diperbarui.
                </p>
            </div>
            <div class="modal-footer" style="border:none;padding:16px 24px;">
                <button type="button" class="btn btn-success" data-dismiss="modal"
                    style="border-radius:8px;padding:8px 24px;font-weight:600;">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const statusInput = document.getElementById("currentStatusValue");
    const photoInput = document.getElementById("currentPhotoValue");
    const updateTimeText = document.getElementById("updateTime");

    updateStepper(parseInt(statusInput.value), {});

    // ===== FORMAT TIMESTAMP =====
    function formatTs(ts) {
        if (!ts) return "";
        let d = new Date(ts.replace(' ', 'T'));
        let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return String(d.getDate()).padStart(2, '0') + ' ' +
            months[d.getMonth()] + ' ' +
            d.getFullYear() + ', ' +
            String(d.getHours()).padStart(2, '0') + ':' +
            String(d.getMinutes()).padStart(2, '0');
    }

    // ===== UPDATE STEPPER =====
    function updateStepper(newStatus, timestamps) {
        const checkIcon = `<svg viewBox="0 0 16 16" width="16" height="16" fill="currentColor">
            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
        </svg>`;

        document.querySelectorAll(".stepper-step").forEach(function(step) {
            let n = parseInt(step.getAttribute("data-step"));
            let statusEl = step.querySelector(".stepper-status");
            let circleEl = step.querySelector(".stepper-circle");
            let timeEl = step.querySelector(".stepper-timestamp");

            step.classList.remove("stepper-completed", "stepper-active", "stepper-pending");

            if (newStatus == 6 || newStatus > n) {
                step.classList.add("stepper-completed");
                statusEl.innerHTML = "✓ Completed";
                circleEl.innerHTML = checkIcon;
            } else if (newStatus === n) {
                step.classList.add("stepper-active");
                statusEl.innerHTML = "● In Progress";
                circleEl.innerHTML = n;
            } else {
                step.classList.add("stepper-pending");
                statusEl.innerHTML = "Pending";
                circleEl.innerHTML = n;
            }

            // Update timestamp chip
            if (timeEl) {
                let ts = timestamps[n];
                if (ts) {
                    timeEl.innerHTML = "🕐 " + formatTs(ts);
                    timeEl.style.display = "inline-flex";
                } else {
                    timeEl.innerHTML = "";
                    timeEl.style.display = "none";
                }
            }
        });
    }

    function getFileName(url) {
        return url ? url.split('/').pop() : "";
    }

    // ===== POLLING =====
    function checkStatus() {
        fetch("{{ route('customer.service.status') }}")
            .then(r => r.json())
            .then(data => {
                if (!data || data.status === undefined) return;

                let currentStatus = parseInt(statusInput.value);
                let currentPhotoFile = getFileName(photoInput.value);
                let newPhotoFile = getFileName(data.photo_url);
                let newTimestamps = data.status_timestamps || {};

                let statusChanged = false;
                let photoChanged = false;

                if (currentStatus !== data.status) {
                    statusInput.value = data.status;
                    document.getElementById("serviceStatus").innerText = data.status;
                    statusChanged = true;
                }

                updateStepper(data.status, newTimestamps);

                if (newPhotoFile && newPhotoFile !== currentPhotoFile) {
                    photoInput.value = data.photo_url;
                    let imgEl = document.querySelector(".photo-container img");
                    if (imgEl) {
                        imgEl.src = data.photo_url + "?t=" + Date.now();
                    } else {
                        document.querySelector(".photo-container").innerHTML =
                            `<img src="${data.photo_url}?t=${Date.now()}" style="width:100%;height:100%;object-fit:contain;">`;
                    }
                    photoChanged = true;
                }

                if (data.updated_at) {
                    // Format: "02 Mar 2026, 06:04"
                    updateTimeText.innerText = "Update: " + formatTs(data.updated_at);
                }

                if (statusChanged || photoChanged) {
                    let msg = statusChanged && photoChanged ?
                        `Status diperbarui ke:<br><strong>${data.status_label}</strong><br><br>Foto bukti servis juga telah diperbaharui.` :
                        statusChanged ?
                        `Status diperbarui ke:<br><strong>${data.status_label}</strong>` :
                        `Foto bukti servis telah diperbaharui.`;
                    document.getElementById("statusMessage").innerHTML = msg;
                    $('#statusChangedModal').modal('show');
                }
            })
            .catch(e => console.log("Polling error:", e));
    }

    setInterval(checkStatus, 3000);
});
</script>

@endsection